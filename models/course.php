<?php
class Course extends AppModel {

	var $name = 'Course';
	var $validate = array(
		'department_id' => array(
			'Error.empty' => array('rule'=>'/.+/','required'=>true,'on'=>'create','message'=>'Error.empty'),
		),
		'owner_id' => array(
			'Error.empty' => array('rule'=>'/.+/','required'=>true,'on'=>'create','message'=>'Error.empty'),
		),
		'code' 				=> array(
			'Error.empty' => array('rule'=>'/.+/','required'=>true,'on'=>'create','message'=>'Error.empty'),
			'Error.maxlength' => array('rule' => array('maxlength', 10)),
			'Error.alphanumeric' => array('rule'=>'alphaNumeric')
		),
		'name' 				=> array(
			'Error.empty' => array('rule'=>'/.+/','required'=>true,'on'=>'create','message'=>'Error.empty'),
			'Error.maxlength' => array('rule' => array('maxlength',150))
			//TODO: No HTML
		),
		'description' 		=> array(
			'Error.empty' => array('rule'=>'/.+/','required'=>true,'on'=>'create','message'=>'Error.empty'),
		)
	);
	
	var $belongsTo = array(
			'Department' => array('className' => 'Department',
								'foreignKey' => 'department_id',
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'counterCache' => ''),
			'Owner' => array('className' => 'Member',
								'foreignKey' => 'owner_id',
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'counterCache' => ''),
	);

}
?>
