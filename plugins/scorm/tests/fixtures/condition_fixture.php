<?php
class ConditionFixture extends CakeTestFixture {
	var $name = 'Condition';
	var $import = array('model'=>'Condition'); 

	var $records = array(
		array(
			'id'					=> 1,
			'referencedObjective'	=> 'HOLA',
			'measureThreshold'		=> '0.05832',
			'operator'			=> 'noOp',
			'condition'			=> 'always'
		)
	);
}
?>
