<?php
class ScoPresentationFixture extends CakeTestFixture {
    var $name = 'ScoPresentation';
	var $table = 'scorm_sco_presentations';
  	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'hideKey' => array('type'=>'string', 'null' => false, 'length' => 10),
			'sco_id' => array('type'=>'integer', 'null' => false),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
    var $records = array(
    	array(
    		'id'		=> 1,
    		'sco_id'    => 1,
    		'hideKey'	=> 'previous'
		),
    );
} 
?>
