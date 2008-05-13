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
		'forum_id' => array(
				'required' => array(
					'rule' => array('custom', '/.+/'),
					'allowEmpty' => false
				)
			),
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
			'dependent' => true,
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
	
	function beforeValidate() {
		parent::beforeValidate();
		if (isset($this->data['Topic']['close'])) {
		 	if ($this->data['Topic']['close']) {
				$this->data['Topic']['status'] = 'locked';
			} else {
				$this->data['Topic']['status'] = 'unlocked';
			}
			unset($this->data['Topic']['close']);
		}
		return true;
	}
	
	function afterFind($results, $primary=false) {
		if ($primary) {
			foreach ($results as $i => $topic) {
				if (!isset($topic['Topic']['status'])) continue;
				$results[$i]['Topic']['close'] = ($topic['Topic']['status'] == 'locked');
			}
		}
		return $results;
	}
	
	function getListSummary($id) {
		$this->restrict(array('Discussion' => array('Member', 'Response' => array('Member' => array('id', 'full_name'))), 'Forum' => array('Course')));
		$this->Discussion->hasMany['Response']['limit'] = 1;
		$this->Discussion->hasMany['Response']['order'] = 'created desc';
		return $this->read(null, $id);
	}
}
?>