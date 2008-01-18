<?php
class RuleFixture extends CakeTestFixture {
	var $name = 'ScormRule';
	var $import = array('model'=>'Rule'); 

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
