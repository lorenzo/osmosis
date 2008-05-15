<?php
class DeliveryControlFixture extends CakeTestFixture {
    var $name = 'ScormDeliveryControl';
	var $table = 'scorm_delivery_controls';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'sco_id' => array('type'=>'integer', 'null' => false),
			'tracked' => array('type'=>'string', 'null' => false, 'default' => 'true', 'length' => 5),
			'completionSetByContent' => array('type'=>'string', 'null' => false, 'default' => 'false', 'length' => 5),
			'objectiveSetByContent' => array('type'=>'string', 'null' => false, 'default' => 'false', 'length' => 5),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
    var $records = array(
    	array(
    		'id'						=> 1,
    		'sco_id'                    => 1,
    		'tracked'					=> 'true',
			'completionSetByContent'	=> 'false',
			'objectiveSetByContent'		=> 'true'
		),
    );
} 
?>
