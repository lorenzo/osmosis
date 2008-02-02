<?php
class Forum extends ForumAppModel {

	var $name = 'Forum';
	var $useTable = 'forum_forums';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Course' => array('className' => 'Forum.Course',
								'foreignKey' => 'course_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasMany = array(
			'Subject' => array('className' => 'Forum.Subject',
								'foreignKey' => 'forum_id',
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
