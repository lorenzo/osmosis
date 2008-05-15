<?php
class RandomizationFixture extends CakeTestFixture {
    var $name = 'ScormRandomization';
  	var $table = 'scorm_randomizations';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'sco_id' => array('type'=>'integer', 'null' => false),
			'randomizationTiming' => array('type'=>'string', 'null' => true, 'default' => 'never', 'length' => 16),
			'selectCount' => array('type'=>'integer', 'null' => true, 'default' => NULL),
			'reorderChildren' => array('type'=>'string', 'null' => false, 'default' => 'false', 'length' => 5),
			'selectionTiming' => array('type'=>'string', 'null' => true, 'default' => 'never', 'length' => 16),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
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
