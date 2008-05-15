<?php
class RuleFixture extends CakeTestFixture {
	var $name = 'Rule';
	var $table = 'scorm_rules'; 
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'sco_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
			'type' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 4),
			'conditionCombination' => array('type'=>'string', 'null' => true, 'default' => 'all', 'length' => 3),
			'action' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 20),
			'minimumPercent' => array('type'=>'string', 'null' => true, 'default' => '0.0000', 'length' => 6),
			'minimumCount' => array('type'=>'string', 'null' => true, 'default' => '0', 'length' => 5),
			'rollup_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $records = array(
		array(
			'id'					=> 1,
			'type'				=> 'pre',
			'conditionCombination'	=> 'any',
			'action'				=> 'disabled',
			'minimumPercent'		=> '0.0000',
			'minimumCount'			=> '1'
		)
	);
}
?>
