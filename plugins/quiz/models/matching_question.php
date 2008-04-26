<?php
class MatchingQuestion extends QuizAppModel {

	var $name = 'MatchingQuestion';
	var $validate = array(
		'body' => array(
			'required' => array(
				'rule' => array('/.+/'),
				'required' => true,
				'message' => 'This field is required',
				'allowEmpty' => false
			)
		),
		'max_associations' => array(
			'natural' => array(
				'rule' => array('custom','/[0-9]+/'),
				'required' => false,
				'message' => 'Must be numeric',
				'allowEmpty' => true
			),
			'nonzero' => array(
				'rule' => array('comparison','>',0),
			),
		),
		'min_associations' => array(
			'natural' => array(
				'rule' => array('custom','/[0-9]+/'),
				'required' => false,
				'message' => 'Must be numeric',
				'allowEmpty' => true
			),
			'minimum' => array(
				'rule' => array('validMinAssocs'),
			),
			'bound' => array(
				'rule' => array('validBoundMinAssocs'),
			),
		)
	);

	var $useTable = 'quiz_matching_questions';

	var $hasMany = array(
		'SourceChoice' => array(
			'className' => 'quiz.MatchingChoice',
			'foreignKey' => 'matching_question_id',
			'conditions' => 'target_id IS NOT NULL',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'dependent' => true,
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'TargetChoice' => array(
			'className' => 'quiz.MatchingChoice',
			'foreignKey' => 'matching_question_id',
			'conditions' => 'target_id IS NULL',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'dependent' => true,
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
	);
	var $hasAndBelongsToMany = array(
			'Quiz' => array(
				'className' => 'quiz.Quiz',
				'joinTable' => 'quiz_matching_questions_quizzes',
				'foreignKey' => 'matching_question_id',
				'associationForeignKey' => 'quiz_id',
				'with' => 'QuizMatching'
			)
	);
	
	function validMinAssocs() {
		return $this->data[$this->alias]['min_associations'] <= $this->data[$this->alias]['max_associations'] ;
	}
	
	function validBoundMinAssocs() {
		return $this->data[$this->alias]['min_associations'] <= count($this->data['SourceChoice']);
	}

	
	function beforeValidate() {
		parent::beforeValidate();
		
		if(!isset($this->data['SourceChoice']) || !isset($this->data['TargetChoice']))
			return false;
		
		$sourceSet = $this->data['SourceChoice'];
		$targetSet = $this->data['TargetChoice'];
		
		$invalidSourceChoices = array();
		foreach ($this->data['SourceChoice'] as $i => $d) {
			$this->SourceChoice->set($d);
			$this->SourceChoice->validates();
			if($this->SourceChoice->validationErrors) {
				$invalidSourceChoices[$i] = $this->SourceChoice->validationErrors;
			} elseif ($d['correct'] > count($targetSet)) {
				$invalidSourceChoices[$i] = array('text' => __('Invalid number for correct answer',true));
			}
						
		}
		$invalidTargetChoices = array();
		foreach ($this->data['TargetChoice'] as $i => $d) {
			$this->TargetChoice->set($d);
			$this->TargetChoice->validates();
			if($this->TargetChoice->validationErrors) {
				$invalidTagetChoices[$i] = $this->TargetChoice->validationErrors;
			}			
		}
		
		if (!empty($invalidSourceChoices)) {
			$this->SourceChoice->validationErrors = $invalidSourceChoices;
			$this->validationErrors['SourceChoice'] = $invalidSourceChoices;
		}
		
		if (!empty($invalidTargetChoices)) {
			$this->TargetChoice->validationErrors = $invalidTargetChoices;
			$this->validationErrors['TargetChoice'] = $invalidTagetChoices;
		}
		
		return true;
	}

}
?>