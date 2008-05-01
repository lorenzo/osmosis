<?php
class Discussion extends AppModel {

	var $name = 'Discussion';
	var $useTable = 'forum_discussions';
	var $validate = array(
		'topic_id' => array('numeric'),
		'member_id' => array('numeric'),
		'title' => array(
			'required' => array(
				'rule' => array('custom', '/.+/'),
				'required' => true,
				'allowEmpty' => false
			)
		),
		'status' => array(
			'valid' => array(
				'rule' => array('custom', '/locked|unlocked/'),
				'required' => true
			)
		)
	);
	var $actsAs = array('Visitable', 'Bindable');
	

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
			'dependent' => true,
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
	
	function beforeValidate() {
		parent::beforeValidate();
		if (isset($this->data['Discussion']['close'])) {
		 	if ($this->data['Discussion']['close']) {
				$this->data['Discussion']['status'] = 'locked';
			} else {
				$this->data['Discussion']['status'] = 'unlocked';
			}
			unset($this->data['Discussion']['close']);
		}
		return true;
	}
	
	function afterFind($results, $primary=false) {
		if ($primary) {
			foreach ($results as $i => $discussion) {
				if (!isset($discussion['Discussion']['status'])) continue;
				$results[$i]['Discussion']['close'] = ($discussion['Discussion']['status'] == 'locked');
			}
		}
		return $results;
	}
	function getDiscussion($id) {
		$this->restrict(
			array(
				'Discussion', 'Member',
				'Topic' => array('id', 'name')
			)
		);
		$discussion = $this->find('first', array('conditions' => array('Discussion.id' => $id), 'count_view' => true));
		return $discussion;
	}
	
	function __construct($id = false, $table = null, $ds = null) {
		$this->setErrorMessage(
			'title.required', __('The title can not be empty',true)
		);
		$this->setErrorMessage(
			'closed.valid', __('??',true)
		);
		parent::__construct($id,$table,$ds);
	}
}
?>