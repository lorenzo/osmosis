<?php
class RuleFixture extends CakeTestFixture {
	var $name = 'Rule';
	var $import = array('model'=>'rule'); 

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
