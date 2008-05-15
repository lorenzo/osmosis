<?php
class ConditionFixture extends CakeTestFixture {
	var $name = 'Condition';
	var $table = 'scorm_conditions';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'referencedObjective' => array('type'=>'string', 'null' => true, 'default' => NULL),
			'measureThreshold' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 7),
			'operator' => array('type'=>'string', 'null' => true, 'default' => 'noOp', 'length' => 4),
			'ruleCondition' => array('type'=>'string', 'null' => false, 'length' => 27),
			'rule_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $records = array(
		array(
			'id'					=> 1,
			'referencedObjective'	=> 'HOLA',
			'measureThreshold'		=> '0.05832',
			'operator'			=> 'noOp',
			'ruleCondition'			=> 'always'
		)
	);
}
?>
