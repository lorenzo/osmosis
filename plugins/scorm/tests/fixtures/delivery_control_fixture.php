<?php
class DeliveryControlFixture extends CakeTestFixture {
    var $name = 'DeliveryControl';
  	var $import = array('model'=>'deliveryControl'); 
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
