<?php
class ChoiceConsiderationFixture extends CakeTestFixture {	
	var $name = 'ScormChoiceConsideration';
	var $useTable = 'scorm_choice_considerations';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'sco_id' => array('type'=>'integer', 'null' => false),
			'preventActivation' => array('type'=>'string', 'null' => false, 'default' => 'false', 'length' => 5),
			'constrainChoice' => array('type'=>'string', 'null' => false, 'default' => 'false', 'length' => 5),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	 var $records = array(
	    	array(
	    		'id'				=> 1,
	    		'preventActivation'	=> 'true',
	    		'constrainChoice'	=> 'false'
			),
	    );
}
?>
