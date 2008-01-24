<?php
class Quiz extends QuizAppModel {

	var $name = 'Quiz';
	var $validate = array(
		'name' =>  array(
			'rule' => VALID_NOT_EMPTY,
			'message' => 'quiz.quiz.name.empty',
			'required' => true,
			'allowEmpty' => false
		),
	);

	var $useTable = 'quiz_quizzes';
	
	var $hasAndBelongsToMany = array(
			'ChoiceQuestion' => array(
				'className' => 'quiz.ChoiceQuestion',
				'joinTable' => 'quiz_choice_questions_quizzes',
				'foreignKey' => 'quiz_id',
				'associationForeignKey' => 'choice_question_id',
				'with' => 'QuizChoice'
			),
			'ClozeQuestion' => array(
				'className' => 'quiz.ClozeQuestion',
				'joinTable' => 'quiz_cloze_questions_quizzes',
				'foreignKey' => 'quiz_id',
				'associationForeignKey' => 'cloze_question_id',
				'with' => 'QuizCloze'
			),
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
			),
	);

}
?>
