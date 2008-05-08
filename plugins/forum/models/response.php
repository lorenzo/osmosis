<?php
class Response extends AppModel {

	var $name = 'Response';
	var $useTable = 'forum_responses';
	var $validate = array(
		//'discussion_id' => array('alphanumeric'),
		// 'member_id' => array('numeric')
	);
	var $actsAs = array('Bindable');
	
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

}
?>