<?php

    /**
     * Tree class file.
     *
     * @author li feixiang  <wastorode@gmail.com>
     * @link http://ycms.sinaapp.com/ 
     * @copyright Copyright &copy; 2011-2015 Ycms Software LLC
     * @license http://www.opensource.org/licenses/bsd-license.php
     */
    defined('INYCMS') or die;

    /**
     * 二叉序列树
     * 
     * @version $Id: Tree.php UTF-8 2011-5-28 13:24:07 li feixiang 
     * @package backend-model
     * @since 1.0
     * 
     */
    abstract class Tree extends YDaoModel
    {

        public $pk = '';
        public $index = 'alias';

        /**
         * Creates the root node
         * @param string $name Name of the new node
         * @return boolean true
         */
        public function createRootNode($index ='root')
        {

            $sql = 'SELECT rgt FROM ' . $this->tableName() . ' ORDER BY rgt DESC LIMIT 1';

            $result = $this->daoQueryRow($sql);

            if ($result === FALSE)
            {
                $lft = 0;
                $rgt = 1;
            }
            else
            {
                $lft = $result['rgt'] + 1;
                $rgt = $lft + 1;
            }

            $sql = 'INSERT INTO ' . $this->tableName() . ' (' . $this->index . ', parent_id, lft, rgt, level, position) VALUES (' . $index . ', 0 , ' . $lft . ', ' . $rgt . ', 0 , 0 );';

            return $this->daoExecute($sql);
        }

        public function getRootTree($fields= '*')
        {
            $fields = $this->joinAttributesSelect($fields);
            $sql = 'SELECT ' . $fields . ' FROM ' . $this->tableName() . ' WHERE parent_id = 0';

            return $this->daoQueryAll($sql);
        }

        /**
         * Gets an object with all data of a node
         * @param integer $id id of the node
         * @return object object with node-data (id, lft, rgt,level)
         */
        protected function getNode($id, $fields= '*')
        {
            $fields = $this->joinAttributesSelect($fields);

            $sql = 'SELECT ' . $fields . ' FROM ' . $this->tableName() . ' WHERE ' . $this->pk . ' = :id ';

            $paArray = array(':id' => array($id, PDO::PARAM_INT));

            $result = $this->daoQueryRow($sql, $paArray);

            if ($result === FALSE)
                throw new CException(Ycms::t('tree', '您请求的树的节点不存在'));

            return $result;
        }

        /**
         * 插入一个节点
         * @param type $attributes
         * @param type $rgt
         * @return type 
         */
        protected function insertNode($attributes, $rgt)
        {
            $sql = 'UPDATE ' . $this->tableName() . ' SET `rgt`= `rgt`+ 2 WHERE `rgt` >= :rgt';
            $paArray = array(':rgt' => array($rgt, PDO::PARAM_INT));
            $this->daoExecute($sql, $paArray);

            $sql = 'UPDATE ' . $this->tableName() . ' SET `lft`= `lft`+ 2 WHERE `lft` >= :rgt ';
            $this->daoExecute($sql, $paArray);

            $condition = $this->joinAttributesInsert($attributes);

            $sql = 'INSERT INTO ' . $this->tableName() . $condition;

            $this->daoExecute($sql, $attributes, 'bindValue');

            return true;
        }

        /**
         * 插入一个子节点
         * @param type $attributes
         * @return type 
         */
        public function insertChildNode($attributes)
        {
            $transaction = $this->getDbConnection()->beginTransaction();
            try
            {
                $pNode = $this->getNode($attributes['parent_id'], 'lft,rgt,level');

                $result = $this->getTree(array($this->pk => $attributes['parent_id']), $this->pk);

                $attributes = array_merge($attributes, array(
                        'lft' => $pNode['rgt'],
                        'rgt' => $pNode['rgt'] + 1,
                        'level' => $pNode['level'] + 1,
                        'position' => count($result)
                            ));

                $this->insertNode($attributes, $pNode['rgt']);
                $transaction->commit();
                return true;
            }
            catch (Exception $e)
            {
                $transaction->rollBack();
                throw new CException($e->getMessage());
            }
        }

        /**
         * 根据父ID获取所有子节点
         * 相当于$this -> getTree ( array ( $this->pk => $parent_id,'order'=>'position','depth'=>1 ) );
         * 
         * @param int $parent_id 父id
         * return array 子节点数组
         */
        public function getChildren($parent_id, $fields='*')
        {
            $fields = $this->joinAttributesSelect($fields);
            $sql = 'SELECT ' . $fields . ' FROM ' . $this->tableName() . ' WHERE `parent_id` = :parent_id ORDER BY `position`';

            return $this->daoQueryAll($sql, array('parent_id' => array($parent_id, PDO::PARAM_INT)));
        }

        /**
         * 获取树
         * @param array $conditions sql中where子句
         * @param string $fields 要查找的字段
         * @return array
         */
        public function getTree($conditions = array(), $fields = '*')
        {
            return $this->loadTree($conditions, $fields);
        }

        /**
         * 加载树
         * @param array $conditions sql中where子句
         * @param string $fields 要查找的字段
         * @return array
         */
        protected function loadTree($conditions = array(), $fields = '*')
        {

            $paArray = array();
            $condition = '';

            $baseConditions = array(
                    'content' => 'node',
                    'order' => 'lft',
                    'depth' => 0,
                    $this->pk => 0,
                    $this->index => '',
            );

            $conditions = array_merge($baseConditions, $conditions);

            if ($this->beforeLoadTree($conditions, $condition, $paArray) === TRUE)
            {
                if ($conditions['content'] === 'node')
                    $condition .= 'node.lft > parent.lft AND node.lft< parent.rgt  ';
                else if ($conditions['content'] === 'all')
                    $condition .= 'node.lft BETWEEN parent.lft AND parent.rgt  ';

                if ($conditions['depth'] !== 0)
                {
                    $condition .= 'AND node.level <= parent.level + :depth ';
                    $paArray[':depth'] = array($conditions['depth'], PDO::PARAM_INT);
                }

                if ($conditions[$this->pk] !== 0)
                {
                    $condition .= 'AND parent.menu_id = :menu_id ';
                    $paArray[':menu_id'] = array($conditions[$this->pk], PDO::PARAM_INT);
                }

                if ($conditions[$this->index] !== '')
                {
                    $condition .= 'AND parent.alias = :alias ';
                    $paArray[':alias'] = array($conditions[$this->index], PDO::PARAM_STR);
                }

                if ($conditions['order'] === 'lft')
                    $order = 'node.lft ';
                else if ($conditions['order'] === 'position')
                    $order = 'node.position ';
            }

            $columns = $this->joinAttributesSelect($fields, 'node');

            $sql = 'SELECT ' . $columns . ' FROM ' . $this->tableName() . ' AS node, ' . $this->tableName() . ' AS parent  WHERE ' . $condition . ' ORDER BY ' . $order;

            return $this->daoQueryAll($sql, $paArray);
        }

        /**
         * 加载树之前自定义查找链接
         * @param array $conditions sql中where子句
         * @param string $condition sql连接子句
         * @param array $paArray 参数绑定
         * @return boolean
         */
        protected function beforeLoadTree(&$conditions, &$condition, &$paArray)
        {
            return TRUE;
        }

        /**
         * Get the HTML code for an unordered list of the tree
         * @return string HTML code for an unordered list of the whole tree
         */
        public function treeAsHtml($conditions = array(), $fields = '*')
        {
            $nextLevel = 0;

            $tree = $this->getTree($conditions, $fields);

            $html = '<ul>\n';
            for ($i = 0; $i < count($tree); $i++)
            {
                $html .= '<li>' . str_repeat('----', $tree[$i]['level']) . $tree[$i][$this->index];

                if (isset($tree[$i + 1]['level']))
                {
                    $nextLevel = $tree[$i + 1]['level'];
                }

                if ($tree[$i]['level'] < $nextLevel)
                {
                    $html .= '\n<ul>\n';
                }
                elseif ($tree[$i]['level'] == $nextLevel)
                {
                    $html .= '</li>\n';
                }
                else
                {
                    $diff = $tree[$i]['level'] - $tree[$i + 1]['level'];
                    $html .= str_repeat('</li>\n</ul>\n', $diff) . '</li>\n';
                }
            }
            $html .= '</ul>\n';
            return $html;
        }

        /**
         * Deletes a node an all it's children
         * @param integer $id id of the node to delete
         * @return boolean true
         */
        public function deleteNode($id)
        {
            $transaction = $this->getDbConnection()->beginTransaction();
            try
            {

                $node = $this->getNode($id, 'lft,rgt,level');
                $nodeSize = $node['rgt'] - $node['lft'] + 1;

                $sql = 'DELETE FROM ' . $this->tableName() . ' WHERE lft BETWEEN ' . $node['lft'] . ' AND ' . $node['rgt'] . ';';
                $this->daoExecute($sql);

                $sql = 'UPDATE ' . $this->tableName() . ' SET lft = lft - ' . $nodeSize . ' WHERE lft > ' . $node['rgt'];
                $this->daoExecute($sql);

                $sql = 'UPDATE ' . $this->tableName() . ' SET rgt = rgt - ' . $nodeSize . ' WHERE rgt > ' . $node['rgt'];
                $this->daoExecute($sql);

                $transaction->commit();
                return TRUE;
            }
            catch (Exception $e)
            {
                $transaction->rollBack();
                throw new CException($e->getMessage());
            }
        }

        /**
         * Deletes a node and increases the level of all children by one
         * @param integer $id id of the node to delete
         * @return boolean true
         */
        public function deleteSingleNode($id)
        {
            $transaction = $this->getDbConnection()->beginTransaction();
            try
            {
                $node = $this->getNode($id, 'lft,rgt,level');
                $nodeSize = $node['rgt'] - $node['lft'] + 1;

                $sql = 'DELETE FROM ' . $this->tableName() . ' WHERE lft = ' . $node['lft'];
                $this->daoExecute($sql);

                $sql = 'UPDATE ' . $this->tableName() . ' SET rgt = rgt - 1, lft = lft - 1 ,level = level-1 WHERE lft BETWEEN ' . $node['lft'] . ' AND ' . $node['rgt'];
                $this->daoExecute($sql);

                $sql = 'UPDATE ' . $this->tableName() . ' SET lft = lft - 2 WHERE lft > ' . $node['rgt'];
                $this->daoExecute($sql);

                $sql = 'UPDATE ' . $this->tableName() . ' SET rgt = rgt - 2 WHERE rgt > ' . $node['rgt'];
                $this->daoExecute($sql);

                $transaction->commit();

                return TRUE;
            }
            catch (Exception $e)
            {
                $transaction->rollBack();
                throw new CException($e->getMessage());
            }
        }

        /**
         * 获取父项目。不包括当前项目
         * @param integer $id id of the node to which the path should point
         * @return array multidimensional array with the data of the nodes in the tree
         */
        public function getParent($conditions = array(), $fields = '*')
        {
            return reset($this->loadParent($conditions, $fields));
        }

        /**
         * 获取路径，用于生成面包蟹
         * @param integer $id id of the node to which the path should point
         * @return array multidimensional array with the data of the nodes in the tree
         */
        public function getPath($conditions = array(), $fields = '*')
        {
            $baseConditions = array(
                    'content' => 'all',
            );
            $conditions = array_merge($conditions, $baseConditions);
            return $this->loadParent($conditions, $fields);
        }

        /**
         * 加载父节点
         * @param array $conditions 查询参数
         * @param mixed $fields 要查询的字段
         * @return array 
         */
        protected function loadParent($conditions = array(), $fields = '*')
        {

            $paArray = array();
            $condition = '';

            $baseConditions = array(
                    'content' => 'parent',
                    'depth' => 0,
                    'level' => null,
                    $this->pk => 0,
                    $this->index => '',
            );

            $conditions = array_merge($baseConditions, $conditions);

            if ($this->beforeloadParent($conditions, $condition, $paArray) === TRUE)
            {
                if ($conditions['content'] === 'parent')
                    $condition .= 'parent.lft < node.lft AND parent.rgt > node.lft ';
                else if ($conditions['content'] === 'all')
                    $condition .= 'node.lft BETWEEN parent.lft AND parent.rgt ';


                if ($conditions['level'] !== null)
                {
                    $condition .= 'AND parent.level = :level ';
                    $paArray[':level'] = array($conditions['level'], PDO::PARAM_INT);
                }
                else if ($conditions['depth'] > 0)
                {
                    $condition .= 'AND parent.level >= node.level - :depth ';
                    $paArray[':depth'] = array($conditions['depth'], PDO::PARAM_INT);
                }

                if ($conditions[$this->pk] !== 0)
                {
                    $condition .= 'AND node.menu_id = :menu_id ';
                    $paArray[':menu_id'] = array($conditions[$this->pk], PDO::PARAM_INT);
                }

                if ($conditions[$this->index] !== '')
                {
                    $condition .= 'AND node.alias = :alias ';
                    $paArray[':alias'] = array($conditions[$this->index], PDO::PARAM_STR);
                }
            }

            $columns = $this->joinAttributesSelect($fields, 'parent');

            $sql = 'SELECT ' . $columns . ' FROM ' . $this->tableName() . ' AS node, ' . $this->tableName() . ' AS parent  WHERE ' . $condition . '  ORDER BY parent.lft';

            return $this->daoQueryAll($sql, $paArray);
        }

        /**
         * 修改加载父节点的查询条件
         * @param array $conditions
         * @param string $condition
         * @param array $paArray
         * @return boolean
         */
        public function beforeloadParent(&$conditions, &$condition, &$paArray)
        {

            return true;
        }

        /**
         * 移动节点到指定位置
         * @param int $id 要移动节点的id
         * @param int $parent_id 新位置所在的父节点id
         * @param int $position 移动节点拿出后。父节点下重新算起的position。从零开始
         * @return boolean 是否移动成功 
         */
        function moveNode($id, $parent_id, $position = 0)
        {
            if ((int) $parent_id === 0 || (int) $id === 1)
            {
                return false;
            }
            $sql = array();
            $node = $this->getNode($id, 'lft,rgt,level,parent_id,position');
            $pNode = $this->getNode($parent_id, 'level,rgt');

            $nchildren = $this->getTree(array($this->pk => $id, 'content' => 'all'), array($this->pk));
            $pchildren = $this->getChildren($parent_id, 'position,lft');

            foreach ($nchildren as $value)
            {
                $nchildrenIds[] = $value[$this->pk];
            }

            if (in_array($parent_id, $nchildrenIds))
            {
                return false;
            }
            //$position的值实际上为节点移动到所在位置后重新算起position，其position值。从零开始
            if ((int) $node['parent_id'] == $parent_id && $position > $node['position'])//如果是在同一目录下，并向右移动则减去一。因为jstree给的位置实际上多了1
            {
                $position = $position - 1;
            }

            $size = $node['rgt'] - $node['lft'] + 1;

            if ($position >= count($pchildren))
            {
                $position = count($pchildren);
            }

            $sql[] = 'UPDATE ' . $this->tableName() . ' SET `position` = `position` - 1  WHERE  `parent_id` = ' . $node['parent_id'] . ' AND  `position` > ' . $node['position']; //原同级所有大于原位置的减去一
            $sql[] = 'UPDATE ' . $this->tableName() . ' SET `lft` = `lft` - ' . $size . ' WHERE `lft` > ' . $node['rgt']; //---用lft判断，不改变父层的lft
            $sql[] = 'UPDATE ' . $this->tableName() . ' SET `rgt` = `rgt` - ' . $size . ' WHERE `rgt` > ' . $node['rgt']; //这两句，当前节点的右侧所有点减去宽度
            //新父亲下同级  大于等于新位置的加一
            $sql[] = 'UPDATE ' . $this->tableName() . ' SET `position` = `position` + 1 WHERE `parent_id` = ' . $parent_id . ' AND `position` >= ' . $position;

            $newPos = $pNode['rgt']; //$newPos 代表我移动后的rgt+1。也就是我的rgt=$newPos-1
            foreach ($pchildren as $v)//循环新父类下节点
            {
                if ($v['position'] == $position)
                {
                    $newPos = (int) $v['lft']; //获得新位置的lft
                    break;
                }
            }
            if ($node['lft'] < $newPos)//如果当前节点lft，小于新位置的lft,由于前面的sql已经将右侧的都减去宽度。所以新位置的也要减去
            {
                $newPos = $newPos - $size;
            }
            //将新位置右边的值恢复成原样
            $sql[] = 'UPDATE ' . $this->tableName() . ' SET `lft` = `lft` + ' . $size . ' WHERE `lft` >= ' . $newPos . ' AND ' . $this->pk . ' NOT IN (' . implode(',', $nchildrenIds) . ') ';
            $sql[] = 'UPDATE ' . $this->tableName() . ' SET `rgt` = `rgt` + ' . $size . ' WHERE `rgt` >= ' . $newPos . ' AND ' . $this->pk . ' NOT IN (' . implode(',', $nchildrenIds) . ') ';

            $idif = $node['lft'] - $newPos;
            $level = $node['level'] - ($pNode['level'] + 1);
            //更新当前position的位置
            $sql[] = 'UPDATE ' . $this->tableName() . ' SET `parent_id` = ' . $parent_id . ', `position` = ' . $position . ' WHERE ' . $this->pk . ' = ' . $id;
            $sql[] = 'UPDATE ' . $this->tableName() . ' SET `lft` = `lft` - ' . $idif . ', `rgt` = `rgt` - ' . $idif . ', `level` = `level` -' . $level . ' WHERE ' . $this->pk . ' IN (' . implode(',', $nchildrenIds) . ') ';

            $transaction = $this->getDbConnection()->beginTransaction();

            try
            {
                foreach ($sql as $q)
                {
                    $this->daoExecute($q);
                }

                $transaction->commit();

                return TRUE;
            }
            catch (Exception $e)
            {
                $transaction->rollBack();
                throw new CException($e->getMessage());
            }
        }

        public function getSizeNode($conditions = array(), $fields = '*')
        {
            $fields = $this->joinAttributesSelect($fields);


            /**
             * 一些条件，配合子语句
             */
            $sql = 'SELECT ' . $fields . ' FROM ' . $this->tableName() . ' WHERE `rgt`-`lft` > 2';

            $result = $this->daoQueryAll($sql);

            return $result;
        }

    }