<?php
/**
 * CActiveRecord class file.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2011 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

/**
 * CActiveFinder implements eager loading and lazy loading of related active records.
 *
 * When used in eager loading, this class provides the same set of find methods as
 * {@link CActiveRecord}.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @version $Id$
 * @package system.db.ar
 * @since 1.0
 */
class CActiveFinder extends CComponent
{
	/**
	 * @var boolean join all tables all at once. Defaults to false.
	 * This property is internally used.
	 */
	public $joinAll=false;
	/**
	 * @var boolean whether the base model has limit or offset.
	 * This property is internally used.
	 */
	public $baseLimited=false;

	private $_joinCount=0;
	private $_joinTree;
	private $_builder;

	/**
	 * Constructor.
	 * A join tree is built up based on the declared relationships between active record classes.
	 * @param CActiveRecord $model the model that initiates the active finding process
	 * @param mixed $with the relation names to be actively looked for
	 */
	public function __construct($model,$with)
	{
		$this->_builder=$model->getCommandBuilder();
		$this->_joinTree=new CJoinElement($this,$model);
		$this->buildJoinTree($this->_joinTree,$with);
	}

	/**
	 * Do not call this method. This method is used internally to perform the relational query
	 * based on the given DB criteria.
	 * @param CDbCriteria $criteria the DB criteria
	 * @param boolean $all whether to bring back all records
	 * @return mixed the query result
	 */
	public function query($criteria,$all=false)
	{
		$this->joinAll=$criteria->together===true;
		$this->_joinTree->beforeFind(false);

		if($criteria->alias!='')
		{
			$this->_joinTree->tableAlias=$criteria->alias;
			$this->_joinTree->rawTableAlias=$this->_builder->getSchema()->quoteTableName($criteria->alias);
		}

		$this->_joinTree->find($criteria);
		$this->_joinTree->afterFind();

		if($all)
		{
			$result = array_values($this->_joinTree->records);
			if ($criteria->index!==null)
			{
				$index=$criteria->index;
				$array=array();
				foreach($result as $object)
					$array[$object->$index]=$object;
				$result=$array;
			}
		}
		else if(count($this->_joinTree->records))
			$result = reset($this->_joinTree->records);
		else
			$result = null;

		$this->destroyJoinTree();
		return $result;
	}

	/**
	 * This method is internally called.
	 * @param string $sql the SQL statement
	 * @param array $params parameters to be bound to the SQL statement
	 * @return CActiveRecord
	 */
	public function findBySql($sql,$params=array())
	{
		Yii::trace(get_class($this->_joinTree->model).'.findBySql() eagerly','system.db.ar.CActiveRecord');
		if(($row=$this->_builder->createSqlCommand($sql,$params)->queryRow())!==false)
		{
			$baseRecord=$this->_joinTree->model->populateRecord($row,false);
			$this->_joinTree->beforeFind(false);
			$this->_joinTree->findWithBase($baseRecord);
			$this->_joinTree->afterFind();
			$this->destroyJoinTree();
			return $baseRecord;
		}
		else
			$this->destroyJoinTree();
	}

	/**
	 * This method is internally called.
	 * @param string $sql the SQL statement
	 * @param array $params parameters to be bound to the SQL statement
	 * @return CActiveRecord[]
	 */
	public function findAllBySql($sql,$params=array())
	{
		Yii::trace(get_class($this->_joinTree->model).'.findAllBySql() eagerly','system.db.ar.CActiveRecord');
		if(($rows=$this->_builder->createSqlCommand($sql,$params)->queryAll())!==array())
		{
			$baseRecords=$this->_joinTree->model->populateRecords($rows,false);
			$this->_joinTree->beforeFind(false);
			$this->_joinTree->findWithBase($baseRecords);
			$this->_joinTree->afterFind();
			$this->destroyJoinTree();
			return $baseRecords;
		}
		else
		{
			$this->destroyJoinTree();
			return array();
		}
	}

	/**
	 * This method is internally called.
	 * @param CDbCriteria $criteria the query criteria
	 * @return string
	 */
	public function count($criteria)
	{
		Yii::trace(get_class($this->_joinTree->model).'.count() eagerly','system.db.ar.CActiveRecord');
		$this->joinAll=$criteria->together!==true;

		$alias=$criteria->alias===null ? 't' : $criteria->alias;
		$this->_joinTree->tableAlias=$alias;
		$this->_joinTree->rawTableAlias=$this->_builder->getSchema()->quoteTableName($alias);

		$n=$this->_joinTree->count($criteria);
		$this->destroyJoinTree();
		return $n;
	}

	/**
	 * Finds the related objects for the specified active record.
	 * This method is internally invoked by {@link CActiveRecord} to support lazy loading.
	 * @param CActiveRecord $baseRecord the base record whose related objects are to be loaded
	 */
	public function lazyFind($baseRecord)
	{
		$this->_joinTree->lazyFind($baseRecord);
		if(!empty($this->_joinTree->children))
		{
			$child=reset($this->_joinTree->children);
			$child->afterFind();
		}
		$this->destroyJoinTree();
	}

	private function destroyJoinTree()
	{
		if($this->_joinTree!==null)
			$this->_joinTree->destroy();
		$this->_joinTree=null;
	}

	/**
	 * Builds up the join tree representing the relationships involved in this query.
	 * @param CJoinElement $parent the parent tree node
	 * @param mixed $with the names of the related objects relative to the parent tree node
	 * @param array $options additional query options to be merged with the relation
	 */
	private function buildJoinTree($parent,$with,$options=null)
	{
		if($parent instanceof CStatElement)
			throw new CDbException(Yii::t('yii','The STAT relation "{name}" cannot have child relations.',
				array('{name}'=>$parent->relation->name)));

		if(is_string($with))
		{
			if(($pos=strrpos($with,'.'))!==false)
			{
				$parent=$this->buildJoinTree($parent,substr($with,0,$pos));
				$with=substr($with,$pos+1);
			}

			// named scope
			$scopes=array();
			if(($pos=strpos($with,':'))!==false)
			{
				$scopes=explode(':',substr($with,$pos+1));
				$with=substr($with,0,$pos);
			}

			if(isset($parent->children[$with]) && $parent->children[$with]->master===null)
				return $parent->children[$with];

			if(($relation=$parent->model->getActiveRelation($with))===null)
				throw new CDbException(Yii::t('yii','Relation "{name}" is not defined in active record class "{class}".',
					array('{class}'=>get_class($parent->model), '{name}'=>$with)));

			$relation=clone $relation;
			$model=CActiveRecord::model($relation->className);

			if($relation instanceof CActiveRelation)
			{
				$oldAlias=$model->getTableAlias(false,false);
				if(isset($options['alias']))
					$model->setTableAlias($options['alias']);
				else if($relation->alias===null)
					$model->setTableAlias($relation->name);
				else
					$model->setTableAlias($relation->alias);
			}

			if(!empty($relation->scopes))
				$scopes=array_merge($scopes,(array)$relation->scopes); // no need for complex merging

			if(!empty($options['scopes']))
				$scopes=array_merge($scopes,(array)$options['scopes']); // no need for complex merging

			$criteria=$model->getDbCriteria();
			$criteria->scopes=$scopes;
			$model->applyScopes($criteria);
			$relation->mergeWith($criteria,true);

			// dynamic options
			if($options!==null)
				$relation->mergeWith($options);

			if($relation instanceof CActiveRelation)
				$model->setTableAlias($oldAlias);

			if($relation instanceof CStatRelation)
				return new CStatElement($this,$relation,$parent);
			else
			{
				if(isset($parent->children[$with]))
				{
					$element=$parent->children[$with];
					$element->relation=$relation;
				}
				else
					$element=new CJoinElement($this,$relation,$parent,++$this->_joinCount);
				if(!empty($relation->through))
				{
					$slave=$this->buildJoinTree($parent,$relation->through,array('select'=>false));
					$slave->master=$element;
					$element->slave=$slave;
				}
				$parent->children[$with]=$element;
				if(!empty($relation->with))
					$this->buildJoinTree($element,$relation->with);
				return $element;
			}
		}

		// $with is an array, keys are relation name, values are relation spec
		foreach($with as $key=>$value)
		{
			if(is_string($value))  // the value is a relation name
				$this->buildJoinTree($parent,$value);
			else if(is_string($key) && is_array($value))
				$this->buildJoinTree($parent,$key,$value);
		}
	}
}


/**
 * CJoinElement represents a tree node in the join tree created by {@link CActiveFinder}.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @version $Id$
 * @package system.db.ar
 * @since 1.0
 */
class CJoinElement
{
	/**
	 * @var integer the unique ID of this tree node
	 */
	public $id;
	/**
	 * @var CActiveRelation the relation represented by this tree node
	 */
	public $relation;
	/**
	 * @var CActiveRelation the master relation
	 */
	public $master;
	/**
	 * @var CActiveRelation the slave relation
	 */
	public $slave;
	/**
	 * @var CActiveRecord the model associated with this tree node
	 */
	public $model;
	/**
	 * @var array list of active records found by the queries. They are indexed by primary key values.
	 */
	public $records=array();
	/**
	 * @var array list of child join elements
	 */
	public $children=array();
	/**
	 * @var array list of stat elements
	 */
	public $stats=array();
	/**
	 * @var string table alias for this join element
	 */
	public $tableAlias;
	/**
	 * @var string the quoted table alias for this element
	 */
	public $rawTableAlias;

	private $_finder;
	private $_builder;
	private $_parent;
	private $_pkAlias;  				// string or name=>alias
	private $_columnAliases=array();	// name=>alias
	private $_joined=false;
	private $_table;
	private $_related=array();			// PK, relation name, related PK => true

	/**
	 * Constructor.
	 * @param CActiveFinder $finder the finder
	 * @param mixed $relation the relation (if the third parameter is not null)
	 * or the model (if the third parameter is null) associated with this tree node.
	 * @param CJoinElement $parent the parent tree node
	 * @param integer $id the ID of this tree node that is unique among all the tree nodes
	 */
	public function __construct($finder,$relation,$parent=null,$id=0)
	{
		$this->_finder=$finder;
		$this->id=$id;
		if($parent!==null)
		{
			$this->relation=$relation;
			$this->_parent=$parent;
			$this->model=CActiveRecord::model($relation->className);
			$this->_builder=$this->model->getCommandBuilder();
			$this->tableAlias=$relation->alias===null?$relation->name:$relation->alias;
			$this->rawTableAlias=$this->_builder->getSchema()->quoteTableName($this->tableAlias);
			$this->_table=$this->model->getTableSchema();
		}
		else  // root element, the first parameter is the model.
		{
			$this->model=$relation;
			$this->_builder=$relation->getCommandBuilder();
			$this->_table=$relation->getTableSchema();
			$this->tableAlias=$this->model->getTableAlias();
			$this->rawTableAlias=$this->_builder->getSchema()->quoteTableName($this->tableAlias);
		}

		// set up column aliases, such as t1_c2
		$table=$this->_table;
		if($this->model->getDbConnection()->getDriverName()==='oci')  // Issue 482
			$prefix='T'.$id.'_C';
		else
			$prefix='t'.$id.'_c';
		foreach($table->getColumnNames() as $key=>$name)
		{
			$alias=$prefix.$key;
			$this->_columnAliases[$name]=$alias;
			if($table->primaryKey===$name)
				$this->_pkAlias=$alias;
			else if(is_array($table->primaryKey) && in_array($name,$table->primaryKey))
				$this->_pkAlias[$name]=$alias;
		}
	}

	/**
	 * Removes references to child elements and finder to avoid circular references.
	 * This is internally used.
	 */
	public function destroy()
	{
		if(!empty($this->children))
		{
			foreach($this->children as $child)
				$child->destroy();
		}
		unset($this->_finder, $this->_parent, $this->model, $this->relation, $this->master, $this->slave, $this->records, $this->children, $this->stats);
	}

	/**
	 * Performs the recursive finding with the criteria.
	 * @param CDbCriteria $criteria the query criteria
	 */
	public function find($criteria=null)
	{
		if($this->_parent===null) // root element
		{
			$query=new CJoinQuery($this,$criteria);
			$this->_finder->baseLimited=($criteria->offset>=0 || $criteria->limit>=0);
			$this->buildQuery($query);
			$this->_finder->baseLimited=false;
			$this->runQuery($query);
		}
		else if(!$this->_joined && !empty($this->_parent->records)) // not joined before
		{
			$query=new CJoinQuery($this->_parent);
			$this->_joined=true;
			$query->join($this);
			$this->buildQuery($query);
			$this->_parent->runQuery($query);
		}

		foreach($this->children as $child) // find recursively
			$child->find();

		foreach($this->stats as $stat)
			$stat->query();
	}

	/**
	 * Performs lazy find with the specified base record.
	 * @param CActiveRecord $baseRecord the active record whose related object is to be fetched.
	 */
	public function lazyFind($baseRecord)
	{
		if(is_string($this->_table->primaryKey))
			$this->records[$baseRecord->{$this->_table->primaryKey}]=$baseRecord;
		else
		{
			$pk=array();
			foreach($this->_table->primaryKey as $name)
				$pk[$name]=$baseRecord->$name;
			$this->records[serialize($pk)]=$baseRecord;
		}

		foreach($this->stats as $stat)
			$stat->query();

		switch(count($this->children))
		{
			case 0:
				return;
			break;
			case 1:
				$child=reset($this->children);
			break;
			default: // bridge(s) inside
				$child=end($this->children);
			break;
		}

		$query=new CJoinQuery($child);
		$query->selects=array();
		$query->selects[]=$child->getColumnSelect($child->relation->select);
		$query->conditions=array();
		$query->conditions[]=$child->relation->condition;
		$query->conditions[]=$child->relation->on;
		$query->groups[]=$child->relation->group;
		$query->joins[]=$child->relation->join;
		$query->havings[]=$child->relation->having;
		$query->orders[]=$child->relation->order;
		if(is_array($child->relation->params))
			$query->params=$child->relation->params;
		$query->elements[$child->id]=true;
		if($child->relation instanceof CHasManyRelation)
		{
			$query->limit=$child->relation->limit;
			$query->offset=$child->relation->offset;
		}

		$child->beforeFind();
		$child->applyLazyCondition($query,$baseRecord);

		$this->_joined=true;
		$child->_joined=true;

		$this->_finder->baseLimited=false;
		$child->buildQuery($query);
		$child->runQuery($query);
		foreach($child->children as $c)
			$c->find();

		if(empty($child->records))
			return;
		if($child->relation instanceof CHasOneRelation || $child->relation instanceof CBelongsToRelation)
			$baseRecord->addRelatedRecord($child->relation->name,reset($child->records),false);
		else // has_many and many_many
		{
			foreach($child->records as $record)
			{
				if($child->relation->index!==null)
					$index=$record->{$child->relation->index};
				else
					$index=true;
				$baseRecord->addRelatedRecord($child->relation->name,$record,$index);
			}
		}
	}

	/**
	 * Apply Lazy Condition
	 * @param CJoinQuery $query represents a JOIN SQL statements
	 * @param CActiveRecord $record the active record whose related object is to be fetched.
	 */
	private function applyLazyCondition($query,$record)
	{
		$schema=$this->_builder->getSchema();
		$parent=$this->_parent;
		if($this->relation instanceof CManyManyRelation)
		{
			if(!preg_match('/^\s*(.*?)\((.*)\)\s*$/',$this->relation->foreignKey,$matches))
				throw new CDbException(Yii::t('yii','The relation "{relation}" in active record class "{class}" is specified with an invalid foreign key. The format of the foreign key must be "joinTable(fk1,fk2,...)".',
					array('{class}'=>get_class($parent->model),'{relation}'=>$this->relation->name)));

			if(($joinTable=$schema->getTable($matches[1]))===null)
				throw new CDbException(Yii::t('yii','The relation "{relation}" in active record class "{class}" is not specified correctly: the join table "{joinTable}" given in the foreign key cannot be found in the database.',
					array('{class}'=>get_class($parent->model), '{relation}'=>$this->relation->name, '{joinTable}'=>$matches[1])));
			$fks=preg_split('/\s*,\s*/',$matches[2],-1,PREG_SPLIT_NO_EMPTY);


			$joinAlias=$schema->quoteTableName($this->relation->name.'_'.$this->tableAlias);
			$parentCondition=array();
			$childCondition=array();
			$count=0;
			$params=array();

			$fkDefined=true;
			foreach($fks as $i=>$fk)
			{
				if(isset($joinTable->foreignKeys[$fk]))  // FK defined
				{
					list($tableName,$pk)=$joinTable->foreignKeys[$fk];
					if(!isset($parentCondition[$pk]) && $schema->compareTableNames($parent->_table->rawName,$tableName))
					{
						$parentCondition[$pk]=$joinAlias.'.'.$schema->quoteColumnName($fk).'=:ypl'.$count;
						$params[':ypl'.$count]=$record->$pk;
						$count++;
					}
					else if(!isset($childCondition[$pk]) && $schema->compareTableNames($this->_table->rawName,$tableName))
						$childCondition[$pk]=$this->getColumnPrefix().$schema->quoteColumnName($pk).'='.$joinAlias.'.'.$schema->quoteColumnName($fk);
					else
					{
						$fkDefined=false;
						break;
					}
				}
				else
				{
					$fkDefined=false;
					break;
				}
			}

			if(!$fkDefined)
			{
				$parentCondition=array();
				$childCondition=array();
				$count=0;
				$params=array();
				foreach($fks as $i=>$fk)
				{
					if($i<count($parent->_table->primaryKey))
					{
						$pk=is_array($parent->_table->primaryKey) ? $parent->_table->primaryKey[$i] : $parent->_table->primaryKey;
						$parentCondition[$pk]=$joinAlias.'.'.$schema->quoteColumnName($fk).'=:ypl'.$count;
						$params[':ypl'.$count]=$record->$pk;
						$count++;
					}
					else
					{
						$j=$i-count($parent->_table->primaryKey);
						$pk=is_array($this->_table->primaryKey) ? $this->_table->primaryKey[$j] : $this->_table->primaryKey;
						$childCondition[$pk]=$this->getColumnPrefix().$schema->quoteColumnName($pk).'='.$joinAlias.'.'.$schema->quoteColumnName($fk);
					}
				}
			}

			if($parentCondition!==array() && $childCondition!==array())
			{
				$join='INNER JOIN '.$joinTable->rawName.' '.$joinAlias.' ON ';
				$join.='('.implode(') AND (',$parentCondition).') AND ('.implode(') AND (',$childCondition).')';
				if(!empty($this->relation->on))
					$join.=' AND ('.$this->relation->on.')';
				$query->joins[]=$join;
				foreach($params as $name=>$value)
					$query->params[$name]=$value;
			}
			else
				throw new CDbException(Yii::t('yii','The relation "{relation}" in active record class "{class}" is specified with an incomplete foreign key. The foreign key must consist of columns referencing both joining tables.',
					array('{class}'=>get_class($parent->model), '{relation}'=>$this->relation->name)));
		}
		else
		{
			$element=$this;
			while($element->slave!==null)
			{
				$query->joins[]=$element->slave->joinOneMany($element->slave,$element->relation->foreignKey,$element,$parent);
				$element=$element->slave;
			}
			$fks=is_array($element->relation->foreignKey) ? $element->relation->foreignKey : preg_split('/\s*,\s*/',$element->relation->foreignKey,-1,PREG_SPLIT_NO_EMPTY);
			$prefix=$element->getColumnPrefix();
			$params=array();
			foreach($fks as $i=>$fk)
			{
				if(!is_int($i))
				{
					$pk=$fk;
					$fk=$i;
				}

				if($this->relation instanceof CBelongsToRelation)
				{
					if(is_int($i))
					{
						if(isset($parent->_table->foreignKeys[$fk]))  // FK defined
							$pk=$parent->_table->foreignKeys[$fk][1];
						else if(is_array($this->_table->primaryKey)) // composite PK
							$pk=$this->_table->primaryKey[$i];
						else
							$pk=$this->_table->primaryKey;
					}
					$params[$pk]=$record->$fk;
				}
				else
				{
					if(is_int($i))
					{
						if(isset($this->_table->foreignKeys[$fk]))  // FK defined
							$pk=$this->_table->foreignKeys[$fk][1];
						else if(is_array($parent->_table->primaryKey)) // composite PK
							$pk=$parent->_table->primaryKey[$i];
						else
							$pk=$parent->_table->primaryKey;
					}
					$params[$fk]=$record->$pk;
				}
			}
			$count=0;
			foreach($params as $name=>$value)
			{
				$query->conditions[]=$prefix.$schema->quoteColumnName($name).'=:ypl'.$count;
				$query->params[':ypl'.$count]=$value;
				$count++;
			}
		}
	}

	/**
	 * Performs the eager loading with the base records ready.
	 * @param mixed $baseRecords the available base record(s).
	 */
	public function findWithBase($baseRecords)
	{
		if(!is_array($baseRecor