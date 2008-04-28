<?php
class MatchingChoice extends QuizAppModel {

	var $name = 'MatchingChoice';
	var $validate = array(
		'matching_question_id' => VALID_NOT_EMPTY,
		'text' => array(
			'required' => array(
				'rule' => array('custom','/.+/'),
				'allowEmpty' => false,
				'required' => true,
				'last' => true
			),
			'natural' => array(
				'rule' => array('validCorrectAnswer')
			)	
		)
	);
	
	var $useTable = 'quiz_matching_choices';
	
	var $belongsTo = array(
			'MatchingQuestion' => array('className' => 'quiz.MatchingQuestion',
								'foreignKey' => 'matching_question_id',
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'counterCache' => '')
	);
	
	
	var $hasMany = array(
		'SourceChoice' => array(
			'className' => 'quiz.MatchingChoice',
			'foreignKey' => 'target_id',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'dependent' => true,
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	function __construct($id = false, $table = null, $ds = null) {
		$this->setErrorMessage(
			'text.required',
			__('Please write the text for this choice',true)
		);
		$this->setErrorMessage(
			'text.natural',
			__('The correct answer should be a number', true)
		);
		parent::__construct($id, $table, $ds);
	}

	function validCorrectAnswer() {
		if($this->alias == 'TargetChoice')
			return true;
		
		return isset($this->data[$this->alias]['correct']) && preg_match('/[0-9]+/',$this->data[$this->alias]['correct']) ;
	}
	
	function save($data, $validate = true, $fields = array()) {
		if (isset($data['SourceChoice'])) {
			$newData['SourceChoice'] = Set::extract($data['SourceChoice'],'{n}.SourceChoice');
			foreach ($newData['SourceChoice'] as $i => $d) {
				$newData['SourceChoice'][$i]['matching_question_id'] = $data['matching_question_id'];
			}
			
			unset($data['SourceChoice']);
			$newData[$this->alias] = $data;
			return $this->saveAll($newData,array('validate' => $validate, 'atomic' => false));
		}
		return parent::save($data,$validate,$fields);
	}

}
?>
