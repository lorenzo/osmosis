<?php
class ChoiceChoice extends QuizAppModel {

	var $name = 'ChoiceChoice';
	var $validate = array(
		'choice_question_id' => VALID_NOT_EMPTY,
		'text' => VALID_NOT_EMPTY,
	);

	var $useTable = 'quiz_choice_choices';
	var $belongsTo = array(
			'ChoiceQuestion' => array('className' => 'quiz.ChoiceQuestion',
								'foreignKey' => 'choice_question_id',
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'counterCache' => ''),
	);

}
?>
