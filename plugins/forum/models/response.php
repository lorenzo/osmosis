<?php
class Response extends ForumAppModel {

	var $name = 'Response';
	var $useTable = 'forum_responses';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Discussion' => array('className' => 'Forum.Discussion',
								'foreignKey' => 'discussion_id',
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

}
?>
