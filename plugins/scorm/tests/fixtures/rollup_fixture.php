<?php
class RollupFixture extends CakeTestFixture {
	var $name = 'Rollup';
	var $import = array('model'=>'rollup'); 

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
