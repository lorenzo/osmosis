<?php
class Quiz extends QuizAppModel {

	var $name = 'Quiz';
	var $validate = array(
		'name' => array(
		    'required' => array(
		        'rule' => array( 'custom','/.+/'),
		        'required' => true,
		        'allowEmpty' => false,
				),
		),
	);

	var $useTable = 'quiz_quizzes';
	var $hasAndBelongsToMany = array(
			'ChoiceQuestion' => array(
				'className' => 'quiz.ChoiceQuestion',
				'joinTable' => 'quiz_choice_questions_quizzes',
				'foreignKey' => 'quiz_id',
				'associationForeignKey' => 'choice_question_id',
				'with' => 'QuizChoice',
				'unique' => true
			),
			// 'ClozeQuestion' => array(
			// 	'className' => 'quiz.ClozeQuestion',
			// 	'joinTable' => 'quiz_cloze_questions_quizzes',
			// 	'foreignKey' => 'quiz_id',
			// 	'associationForeignKey' => 'cloze_question_id',
			// 	'with' => 'QuizCloze'
			// ),
			'MatchingQuestion' => array(
				'className' => 'quiz.MatchingQuestion',
				'joinTable' => 'quiz_matching_questions_quizzes',
				'foreignKey' => 'quiz_id',
				'associationForeignKey' => 'matching_question_id',
				'with' => 'QuizMatching'
			),
			'OrderingQuestion' => array(
				'className' => 'quiz.OrderingQuestion',
				'joinTable' => 'quiz_ordering_questions_quizzes',
				'foreignKey' => 'quiz_id',
				'associationForeignKey' => 'ordering_question_id',
				'with' => 'QuizOrdering'
			),
			'TextQuestion' => array(
				'className' => 'quiz.TextQuestion',
				'joinTable' => 'quiz_text_questions_quizzes',
				'foreignKey' => 'quiz_id',
				'associationForeignKey' => 'text_question_id',
				'with' => 'QuizText',
				'unique' => true
			),
	);
	function __construct($id = false, $table = null, $ds = null) {
			$this->setErrorMessage(
				'name.required', __('The name can not be empty',true)
			);
			parent::__construct($id,$table,$ds);
	}

	function getQuestions($question_type=null, $quiz_id = null) {
		if ($question_type==null) {
			return null;
		}
		
		if (!is_array($question_type)) {
			$question_type = array($question_type);
		} else {
			$question_type = array_keys($question_type);
		}
		$questions = array();
		foreach ($question_type as $type) {
			$questionType = Inflector::Camelize($type);
			$quiz_questions = array();
			if ($quiz_id) {
				$quiz_questions = $this->read(null, $quiz_id);
				$quiz_questions = Set::extract($quiz_questions, $questionType . '.{n}.id');
			}
			$questions[$questionType] = $this->{$questionType}->find(
				'all',
				array(
					'conditions' => array(
						'NOT' => array('id' => $quiz_questions)
					)
				)
			);
		}
		return $questions;
	}

	function addQuestions($question_list = array()) {
		foreach($question_list as $type => $questions) {
			if (!isset($this->hasAndBelongsToMany[$type])) {
				continue;
			}
			$habtm = $this->hasAndBelongsToMany[$type];
			$with = $habtm['with'];
			foreach ($questions as $question_id) {
				if ($question_id==0) continue;
				$save = array(
					$habtm['associationForeignKey'] => $question_id,
					'quiz_id' => $this->id
				);
				$this->{$with}->create();
				if (!$this->{$with}->save($save)) {
					return false;
				}
			}
		}
		return true;
	}
}
?>
