<?php
class Department extends AppModel {

	var $name = 'Department';
	var $validate = array(
		'name' => array('Error.empty' => VALID_NOT_EMPTY),
		'description' => array('Error.empty' => VALID_NOT_EMPTY),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Course' => array('className' => 'Course',
								'foreignKey' => 'department_id',
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'dependent' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''),
	);

}
?>