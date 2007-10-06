<?php
class RandomizationFixture extends CakeTestFixture {
    var $name = 'Randomization';
  	var $import = array('model' => 'Randomization'); 
    var $records = array(
    	array(
    		'id'					=> 1,
    		'randomizationTiming'	=> 'once',
    		'selectCount'			=> '12',
    		'reorderChildren'		=> 'true',
    		'selectionTiming'		=> 'onEachNewAttempt'
		),
    );
} 
?>