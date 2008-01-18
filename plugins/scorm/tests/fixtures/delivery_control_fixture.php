<?php
class DeliveryControlFixture extends CakeTestFixture {
    var $name = 'ScormDeliveryControl';
  	var $import = array('model'=>'DeliveryControl'); 
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
