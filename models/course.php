<?php
class Course extends AppModel {

	var $name = 'Course';
	var $validate = array(
		'department_id' => array(
		    'Error.empty' => array(
		        'rule' => array('custom','/.+/'),
		        'required' => true,
		        'on' => 'create',
	        )
		),
		// 'owner_id' => array(
		//     'Error.empty' => array(
		//         'rule' => array('custom','/.+/'),
		//         'required' => true,
		//         'on' => 'create',
		// 	)
		// ),
		'code' => array(
			'Error.maxlength' => array(
		        'rule' => array('maxlength',10)
			),
			'Error.empty' => array(
		        'rule' => array('custom','/.+/'),
		        'required' => true,
		        'on' => 'create',
			),
		),
		'name' => array(
		    'Error.empty' => array(
		        'rule' => array('custom','/.+/'),
		        'required' => true,
		        'on' => 'create',
			),
			'Error.maxlength' => array(
					'rule' => array( 'maxlength',150),
			),
			//TODO: No HTML
		),
		'description' => array(
		    'Error.empty' => array(
		        'rule' => array('custom','/.+/'),
		        'required' => true,
		        'on' => 'create',
			),
		)
	);
	
	var $belongsTo = array(
			'Department' => array('className' => 'Department',
								'foreignKey' => 'department_id',
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'counterCache' => ''),
			// 'Owner' => array('className' => 'Member',
			// 					'foreignKey' => 'owner_id',
			// 					'conditions' => '',
			// 					'fields' => '',
			// 					'order' => '',
			// 					'counterCache' => ''),
	);
	
	var $hasAndBelongsToMany = array(
			'Tool' => array(
				'className' => 'Plugin',
				'joinTable' => 'course_tools',
				'foreignKey' => 'course_id',
				'associationForeignKey' => 'plugin_id',
				'with' => 'CourseTool'
			)
	);
	
	function __construct($id = false, $table = null, $ds = null) {
			$this->validate['department_id']['Error.empty']['message'] = __('The department can not be empty',true);
			$this->validate['owner_id']['Error.empty']['message'] = __('The owner can not be empty',true);
			$this->validate['code']['Error.empty']['message'] = __('The code can not be empty',true);
			$this->validate['code']['Error.empty']['message'] = __('This field ',true);
			$this->validate['name']['Error.empty']['message'] = __('The name can not be empty',true);
			$this->validate['name']['Error.maxlength']['message'] = __('The name must be ubder 150 characters',true);
			$this->validate['description']['Error.empty']['message'] = __('The description can no be empty',true);
			parent::__construct($id,$table,$ds);
	}

	function enroll($member_id,$role = 'attendee',$course_id = null) {
		if (!empty($this->id))
			$course_id = $this->id;
		else
			return false;
			
		$this->bindModel(array('hasAndBelongsToMany' => array('Member')));
		return $this->Member->Enrollment->save(array('course_id' => $course_id,'member_id' => $member_id, 'role' => $role));
	}	
		
	function alreadyEnrolled($id, $new_course_id) {
		$this->bindModel(array('hasAndBelongsToMany' => array('Member')));
		$courses = $this->Member->courses($id);
		$courses = Set::extract('/Course/id', $courses);
		return in_array($new_course_id, $courses);
	}
}
?>
