<?php
class ChoiceConsiderationFixture extends CakeTestFixture {
    var $name = 'ScormChoiceConsideration';
  	var $import = array('model'=>'ChoiceConsideration'); 
    var $records = array(
    	array(
    		'id'				=> 1,
    		'preventActivation'	=> 'true',
    		'constrainChoice'	=> 'false'
		),
    );
} 
?>
