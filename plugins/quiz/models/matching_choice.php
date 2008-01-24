<?php
class MatchingChoice extends AppModel {

	var $name = 'MatchingChoice';
	var $validate = array(
		'matching_question_id' => VALID_NOT_EMPTY,
		'text' => VALID_NOT_EMPTY,
		'source' => VALID_NOT_EMPTY,
	);

	var $useTable = 'quiz_matching_choices';

	var $hasAndBelongsToMany = array(
		'SourceChoice' => array(
			'className' => 'quiz.MatchingQuestion',
			'joinTable' => 'quiz_matching_choices_matching_questions',
			'foreignKey' => 'matching_question_id',
			'associationForeignKey' => 'source',
			'with' => 'MatchingQuestionChoices'
		)/*,
		'TargetChoice' => array(
			'className' => 'quiz.MatchingQuestion',
			'joinTable' => 'quiz_matching_choices_matching_questions',
			'foreignKey' => 'matching_question_id',
			'associationForeignKey' => 'target',
			'with' => 'MatchingQuestionChoices'
		)*/
	);
	

}
?>
