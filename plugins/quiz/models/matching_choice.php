<?php
class MatchingChoice extends QuizAppModel {

	var $name = 'MatchingChoice';
	var $validate = array(
		'matching_question_id' => VALID_NOT_EMPTY,
		'text' => array(
			'algo' => array(
				'rule' => array('esta'),
				'message' => 'hola'
			)
		)
	);
	
function esta() {
	$data = $this->data['SourceChoice'];
	if (!empty($data['text']) && empty($data['correct'])) return false;
	return true;
}

	var $useTable = 'quiz_matching_choices';

	var $hasAndBelongsToMany = array(
		/*'SourceChoice' => array(
			'className' => 'quiz.MatchingQuestion',
			'joinTable' => 'quiz_matching_choices_matching_questions',
			'foreignKey' => 'matching_question_id',
			'associationForeignKey' => 'source',
			'with' => 'MatchingQuestionChoices'
		),
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
