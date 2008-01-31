<?php
class MatchingQuestion extends QuizAppModel {

	var $name = 'MatchingQuestion';
	var $validate = array(
		'body' => VALID_NOT_EMPTY,
		'shuffle' => VALID_NOT_EMPTY,
		'max_associations' => VALID_NOT_EMPTY,
	);

	var $useTable = 'quiz_matching_questions';

	var $hasAndBelongsToMany = array(
			'Quiz' => array(
				'className' => 'quiz.Quiz',
				'joinTable' => 'quiz_matching_questions_quizzes',
				'foreignKey' => 'matching_question_id',
				'associationForeignKey' => 'quiz_id',
				'with' => 'QuizMatching'
			),
			'SourceChoice' => array(
				'className' => 'quiz.MatchingChoice',
				'joinTable' => 'quiz_matching_choices_matching_questions',
				'foreignKey' => 'matching_question_id',
				'associationForeignKey' => 'source',
				'with' => 'MatchingQuestionChoices'
			),
			'TargetChoice' => array(
				'className' => 'quiz.MatchingChoice',
				'joinTable' => 'quiz_matching_choices_matching_questions',
				'foreignKey' => 'matching_question_id',
				'associationForeignKey' => 'target',
				'with' => 'MatchingQuestionChoices'
			)
	);

}
?>
