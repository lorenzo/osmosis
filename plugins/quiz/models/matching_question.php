<?php
class MatchingQuestion extends AppModel {

	var $name = 'MatchingQuestion';
	var $validate = array(
		'body' => VALID_NOT_EMPTY,
		'shuffle' => VALID_NOT_EMPTY,
		'max_associations' => VALID_NOT_EMPTY,
	);

	var $useTable = 'quiz_matching_questions';
	var $hasMany = array(
			'MatchingChoice' => array('className' => 'quiz.MatchingChoice',
								'foreignKey' => 'matching_question_id',
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
			'Quiz' => array(
				'className' => 'quiz.Quiz',
				'joinTable' => 'quiz_matching_questions_quizzes',
				'foreignKey' => 'matching_question_id',
				'associationForeignKey' => 'quiz_id',
				'with' => 'QuizMatching'
			),
	);

}
?>
