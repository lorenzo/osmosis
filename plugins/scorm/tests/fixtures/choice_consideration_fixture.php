<?php
class ChoiceConsiderationFixture extends CakeTestFixture {
    var $name = 'ChoiceConsideration';
  	var $import = array('model' => 'ChoiceConsideration'); 
    var $records = array(
    	array(
    		'id'				=> 1,
    		'preventActivation'	=> 'true',
    		'constrainChoice'	=> 'false'
		),
    );
} 
?>