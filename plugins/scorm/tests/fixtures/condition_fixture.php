<?php
class ConditionFixture extends CakeTestFixture {
	var $name = 'ScormCondition';
	var $import = array('model'=>'Condition'); 

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
