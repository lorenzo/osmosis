<?php
class Discussion extends ForumAppModel {

	var $name = 'Discussion';
	var $useTable = 'forum_discussions';
	var $validate = array(
		'title' => array(
			'rule' => array('range',1,255)
			),
		'status' => array('alphaNumeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Subject' => array('className' => 'Forum.Subject',
								'foreignKey' => 'subject_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Member' => array('className' => 'Member',
								'foreignKey' => 'member_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasMany = array(
			'Response' => array('className' => 'Forum.Response',
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
