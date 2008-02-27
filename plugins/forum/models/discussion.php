<?php
class Discussion extends ForumAppModel {

	var $name = 'Discussion';
	var $useTable = 'forum_discussions';
	var $validate = array(
		'tittle' => array(
		    'rule' => array(
		        'rule' => array( 'range',1,255),
				),
		),
		'status' => array(
		    'valid' => array(
		        'rule' => array( 'alphaNumeric'),
				),
		),
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
	
	function __construct($id = false, $table = null, $ds = null) {
			$this->validate['tittle']['rule']['message'] = __('The title can not be empty',true);
			$this->validate['status']['valid']['message'] = __('The status must be an alphanumeric value',true);
			parent::__construct($id,$table,$ds);
	}

}
?>
