<?php
class Topic extends AppModel {

	var $name = 'Topic';
	var $useTable = 'forum_topics';
	var $validate = array(
		'name' => array(
			'required' => array(
				'rule' => array('custom', '/.+/'),
				'allowEmpty' => false
			)
		),
		'status' => array(
			'required' => array(
				'rule' => array('custom', '/.+/'),
				'allowEmpty' => false
			)
		),
		'forum_id' => array('numeric')
	);
	var $actsAs = array('Bindable');
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Forum' => array(
			'className' => 'Forum.Forum',
			'foreignKey' => 'forum_id',
			'conditions' => '',
			'fields' => array('id', 'course_id'),
			'order' => ''
		)
	);

	var $hasMany = array(
		'Discussion' => array(
			'className' => 'Forum.Discussion',
			'foreignKey' => 'topic_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => 'sticky desc, created desc',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	function __construct($id = false, $table = null, $ds = null) {
		$this->setErrorMessage(
			'name.required', __('The name can not be empty',true)
		);
		parent::__construct($id,$table,$ds);
	}
	
	function getListSummary($id) {
		$this->restrict(array('Discussion' => array('Member', 'Response' => array('Member' => array('id', 'full_name'))), 'Forum' => array('Course')));
		$this->Discussion->hasMany['Response']['limit'] = 1;
		$this->Discussion->hasMany['Response']['order'] = 'created desc';
		return $this->read(null, $id);
	}
}
?>