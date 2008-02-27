<?php
class Subject extends ForumAppModel {

	var $name = 'Subject';
	var $useTable = 'forum_subjects';
	var $validate = array(
		'title' => array(
			'rule'=> array('minLength',1)
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Forum' => array('className' => 'Forum.Forum',
								'foreignKey' => 'forum_id',
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
			'Discussion' => array('className' => 'Forum.Discussion',
								'foreignKey' => 'subject_id',
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
	function __construct($id = false, $table = null, $ds = null) {
			$this->validate['title']['rule']['message'] = __('The title can not be empty',true);
			parent::__construct($id,$table,$ds);
	}
}
?>
