<?php
class Discussion extends AppModel {

	var $name = 'Discussion';
	var $useTable = 'forum_discussions';
	var $validate = array(
		'topic_id' => array('numeric'),
		'member_id' => array('numeric'),
		// 'title' => array('alphanumeric'),
		'locked' => array('numeric'),
		// 'status' => array('alphanumeric')
	);
	var $actsAs = array(
		'Forum.Visitable' => array()
	);
	

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Topic' => array(
			'className' => 'Forum.Topic',
			'foreignKey' => 'topic_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'member_id',
			'conditions' => '',
			'fields' => array('id', 'full_name', 'username'),
			'order' => ''
		)
	);

	var $hasMany = array(
		'Response' => array(
			'className' => 'Forum.Response',
			'foreignKey' => 'discussion_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
?>