<?php
class Response extends AppModel {

	var $name = 'Response';
	var $useTable = 'forum_responses';
	var $validate = array(
		'content' => array(
			'required' => array(
				'rule' => array('/.+/'),
				'required' => true,
				'allowEmpty' => false
			)
		)
		//'discussion_id' => array('alphanumeric'),
		// 'member_id' => array('numeric')
	);
	var $actsAs = array('Bindable', 'Loggable');
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Discussion' => array(
			'className' => 'Forum.Discussion',
			'foreignKey' => 'discussion_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => array('skipUpdates' => false)
		),
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'member_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function __construct($id = false, $table = null, $ds = null) {
		$this->setErrorMessage(
			'content.required',
			__('Please write a response',true)
		);
		parent::__construct($id, $table, $ds);
	}
}
?>