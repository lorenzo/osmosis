<?php
class RollupFixture extends CakeTestFixture {
	var $name = 'Rollup';
	var $table = 'scorm_rollups';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'sco_id' => array('type'=>'integer', 'null' => false),
			'rollupObjectiveSatisfied' => array('type'=>'string', 'null' => true, 'default' => 'true', 'length' => 5),
			'rollupProgressCompletion' => array('type'=>'string', 'null' => true, 'default' => 'true', 'length' => 5),
			'objectiveMeasureWeight' => array('type'=>'string', 'null' => true, 'default' => '1.0000', 'length' => 20),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $records = array(
		array(
			'id'						=> 1,
			'rollupObjectiveSatisfied'	=> 'true',
			'rollupProgressCompletion'	=> 'false',
			'objectiveMeasureWeight'		=> '0.5000'
		)
	);
}
?>
