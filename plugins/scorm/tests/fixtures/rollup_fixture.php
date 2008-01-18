<?php
class RollupFixture extends CakeTestFixture {
	var $name = 'ScormRollup';
	var $import = array('model'=>'Rollup'); 

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
