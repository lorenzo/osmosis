<?php
class Department extends AppModel {

	var $name = 'Department';
	var $validate = array(
		'name' => array(
		    'Error.empty' => array(
		        'rule' => array( 'custom','/.+/'),
				),
		),
		'description' => array(
		    'Error.empty' => array(
		        'rule' => array('custom','/.+/'),
				),
		),
	);

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
	function __construct($id = false, $table = null, $ds = null) {
			$this->validate['name']['Error.empty']['message'] = __('The name can not be empty',true);
			$this->validate['description']['Error.empty']['message'] = __('The description can not be empty',true);
			parent::__construct($id,$table,$ds);
	}
}
?>
