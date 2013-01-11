<?php
/**
 * This is the template for generating the model class of a specified table.
 * - $this: the ModelCode object
 * - $tableName: the table name for this class (prefix is already removed if necessary)
 * - $modelClass: the model class name
 * - $columns: list of table columns (name=>CDbColumnSchema)
 * - $labels: list of attribute labels (name=>label)
 * - $rules: list of validation rules
 * - $relations: list of relations (name=>relation declaration)
 */
?>
<?php echo "<?php\n"; ?>
/**
 * <?php echo $tableName; ?> model class file.
 *
 * @author li feixiang <wastorode@gmail.com>
 * @link http://ycms.sinaapp.com/
 * @copyright Copyright (c) 2005-2011 Ycms. 
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
 
 defined ( 'INYCMS' ) or die;
  
/**
* 数据库表"<?php echo $tableName; ?>"的model类.
*
* The followings are the available columns in table '<?php echo $tableName; ?>':
<?php foreach ($columns as $column): ?>
* @property <?php echo $column->type . ' $' . $column->name . "\n"; ?>
<?php endforeach; ?>
<?php if (!empty($relations)): ?>
*
* The followings are the available model relations:
<?php foreach ($relations as $name => $relation): ?>
* @property <?php
if (preg_match("~^array\(self::([^,]+), '([^']+)', '([^']+)'\)$~", $relation, $matches)) {
    $relationType = $matches[1];
    $relationModel = $matches[2];

    switch ($relationType) {
        case 'HAS_ONE':
            echo $relationModel . ' $' . $name . "\n";
            break;
        case 'BELONGS_TO':
            echo $relationModel . ' $' . $name . "\n";
            break;
        case 'HAS_MANY':
            echo $relationModel . '[] $' . $name . "\n";
            break;
        case 'MANY_MANY':
            echo $relationModel . '[] $' . $name . "\n";
            break;
        default:
            echo 'mixed $' . $name . "\n";
    }
}
?>
    <?php endforeach; ?>
<?php endif; ?>
*
* @version $Id: <?php echo $tableName; ?>.php UTF-8 <?php echo date('Y-m-d H:i:s') ?> li feixiang
* @package backend-model
* @since 1.0
*/
class <?php echo $modelClass; ?> extends YDaoModel
{
	/**
         * 该模型关联的数据库表名
         *      
	 * @return      string          该模型关联的数据库表名
	 * @since	1.0
	 */
	public static function tableName()
	{
		return '{{<?php echo $tableName; ?>}}';
	}

	/**
	 * 字段验证规则
         *
         * boolean-captcha-compare-email-default-exist-file-filter-in-length-match-numerical-required-type-unique-url
         * return       array
	 * @since	1.0
	 */
	public function rules()
	{
                return array(
            <?php foreach ($rules as $rule): ?>
                <?php echo $rule . ",\n"; ?>
            <?php endforeach; ?>
                array('<?php echo implode(', ', array_keys($columns)); ?>', 'safe'),
		);
	}
      
	/**
         * 字段label
         *
	 * @return      array           customized attribute labels (name=>label)
	 * @since	1.0
	 */
	public function attributeLabels()
	{
		return array(
            <?php foreach ($labels as $name => $label): ?>
                <?php echo "'$name' =>Ycms::t('".strtolower($modelClass)."' ,'$label'),\n"; ?>
            <?php endforeach; ?>
		);
	}

	/**
         * 字段说明
         *
	 * @return      array           customized attribute hints (name=>hint)
	 * @since	1.0
	 */
	public function attributeHints()
	{
		return array(
            <?php foreach ($labels as $name => $label): ?>
                <?php echo "'$name' =>Ycms::t('".strtolower($modelClass)."' ,'$label'),\n"; ?>
            <?php endforeach; ?>
		);
	} 

}
