<?php
class ChoiceQuestion extends QuizAppModel {

	var $name = 'ChoiceQuestion';
	var $validate = array(
		'body' => VALID_NOT_EMPTY,
		'shuffle' => VALID_NOT_EMPTY
	);

	var $useTable = 'quiz_choice_questions';
	var $hasMany = array(
			'ChoiceChoice' => array('className' => 'quiz.ChoiceChoice',
								'foreignKey' => 'choice_question_id',
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'dependent' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''),
	);

	var $hasAndBelongsToMany = array(
			'Quiz' => array('className' => 'quiz.Quiz',
						'joinTable' => 'quiz_choice_questions_quizzes',
						'foreignKey' => 'choice_question_id',
						'associationForeignKey' => 'quiz_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'unique' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => '',
						'with' => 'QuizChoice'),
	);

}
?>