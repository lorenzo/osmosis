<?php
class Course extends AppModel {

	var $name = 'Course';
	var $validate = array(
		'department_id' => VALID_NOT_EMPTY,
		'owner_id' => VALID_NOT_EMPTY,
		'code' => VALID_NOT_EMPTY,
		'name' => VALID_NOT_EMPTY,
		'description' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Department' => array('className' => 'Department',
								'foreignKey' => 'department_id',
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'counterCache' => ''),
			/*'Owner' => array('className' => 'Owner',
								'foreignKey' => 'owner_id',
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'counterCache' => ''),*/
	);

}
?>