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
			),
			'natural' => array(
				'rule' => array('validCorrectAnswer'),
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
								'counterCache' => ''),
			'TargetChoice' =>	array('className' => 'quiz.MatchingChoice',
								'foreignKey' => 'target_id',
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'counterCache' => ''),
	);

	function validCorrectAnswer() {
		if($this->alias == 'TargetChoice')
			return true;
		return isset($this->data[$this->alias]['correct']) && preg_match('/[0-9]+/',$this->data[$this->alias]['correct']);
	}
	
	function save($data, $validate = true, $fields = array()) {
		if (isset($data['TargetChoice'])) {
			$newData['TargetChoice'] = $data['TargetChoice']; 
			$newData['TargetChoice']['matching_question_id'] = $data['matching_question_id'];
			unset($data['TargetChoice']);
			$newData[$this->alias] = $data;
			return $this->saveAll($newData,array('validate' => $validate, 'atomic' => false));
		}
		return parent::save($data,$validate,$fields);
	}

}
?>
