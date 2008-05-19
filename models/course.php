<?php
/**
 * Model Class that represents a Course.
 */
class Course extends AppModel {

	var $name = 'Course';
	var $validate = array(
		'department_id' => array(
		    'empty' => array(
		        'rule' => array('custom','/.+/'),
		        'required' => true,
		        'on' => 'create'
	        )
		),
		'owner_id' => array(
		    'empty' => array(
		        'rule' => array('custom','/.+/'),
		        'required' => true,
		        'on' => 'create'
			)
		),
		'code' => array(
			'empty' => array(
		        'rule' => array('custom','/.+/'),
		        'required' => true
	        ),
			'maxlength' => array(
		        'rule'		=> array('maxlength',10),
				'required'	=> true,
				'allowEmpty'=> false
			)
		),
		'name' => array(
		    'empty' => array(
		        'rule' => array('custom','/.+/'),
		        'required' => true,
		        'on' => 'create',
			),
			'maxlength' => array(
				'rule' => array( 'maxlength',150),
			)
		),
		'description' => array(
		    'empty' => array(
		        'rule' => array('custom','/.+/'),
		        'required' => true,
		        'on' => 'create',
			),
		)
	);
	
	/**
	 * BelongsTo (1-N) relation descriptors
	 *
	 * @var array
	 **/
	var $belongsTo = array(
		// Course BelongsTo Department
		'Department' => array(
			'className' => 'Department',
			'foreignKey' => 'department_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => ''
		),
		// Course BelongsTo Member (Owner)
		'Owner' => array(
			'className' => 'Member',
			'foreignKey' => 'owner_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => ''
		)
	);
	
	/**
	 * HasAndBelongsToMany (N-N) relation descriptors
	 */
	var $hasAndBelongsToMany = array(
		// Course HABTM Plugin (Active Tools for the course)
		'Tool' => array(
			'className' => 'Plugin',
			'joinTable' => 'course_tools',
			'foreignKey' => 'course_id',
			'associationForeignKey' => 'plugin_id',
			'with' => 'CourseTool'
		)
	);
	
	/**
	 * Constructor of the class. Startups avlidation error messages with i18n.
	 */
	function __construct($id = false, $table = null, $ds = null) {
		$this->setErrorMessage(
			'department_id.empty',
			__('Please select a departement',true)
		);
		$this->setErrorMessage(
			'owner_id.empty',
			__('Please set the course owner',true)
		);
		$this->setErrorMessage(
			'code.maxlength',
			__('The length of this field should be less than 10',true)
		);
		$this->setErrorMessage(
			'name.empty',
			__('Please write the Course name',true)
		);
		$this->setErrorMessage(
			'name.maxlength',
			__('The lenght of the name should be lees than 150',true)
		);
		$this->setErrorMessage(
			'description.empty',
			__('Please write the course description',true)
		);
		parent::__construct($id,$table,$ds);
	}

	/**
	 * Manages member enrollment into the course.
	 * 
	 * @param int $member_id ID of the member to enroll.
	 * @param String $role Role that the member will be assigned in the course.
	 * @param int $course_id ID of the course to enroll the member.
	 * @return mixed On success data saved if its not empty or true, false on failure.
	 * @access public
	 */
	function enroll($member_id,$role = 'attendee',$course_id = null) {
		if (empty($this->id)) {
			return false;
		}
		$course_id = $this->id;
		$this->bindModel(array('hasAndBelongsToMany' => array('Member')));
		return $this->Member->Enrollment->save(array('course_id' => $course_id,'member_id' => $member_id, 'role' => $role));
	}	
	
	/**
	 * Determines wether a member is enrolled in a course.
	 * 
	 * @param int $member_id ID of the member.
	 * @param int $id ID of the course.
	 * @return boolean true if the member is enrolled in the course. 
	 */
	function alreadyEnrolled($member_id, $id) {
		$this->bindModel(array('hasAndBelongsToMany' => array('Member')));
		$courses = $this->Member->courses($member_id);
		$courses = Set::extract('/Course/id', $courses);
		return in_array($id, $courses);
	}
	
	/**
	 * Gets the professors of the course.
	 * 
	 * @param int $id ID of the course.
	 * @return Array professors of the course.
	 */
	function professors($id) {
		$this->bindModel(array('hasAndBelongsToMany' => array('Member')));
		return $this->Member->Enrollment->find(
			'all',
			array(
				'conditions' => array(
					'course_id' => $id, 'role' => 'professor'
				)
			)
		);
	}
}
?>
