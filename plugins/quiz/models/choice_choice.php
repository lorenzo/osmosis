<?php
class ChoiceChoice extends QuizAppModel {

	var $name = 'ChoiceChoice';
	var $validate = array(
		// 'choice_question_id' => VALID_NOT_EMPTY,
		'text' => array(
			'required' => array(
				'rule' => array('custom', '/.+/')
			)
		)
	);

	var $useTable = 'quiz_choice_choices';

	function __construct($id = false, $table = null, $ds = null) {
		$this->setErrorMessage(
			'text.required',
			__('Please write the text for this choice',true)
		);
		parent::__construct($id, $table, $ds);
	}
}
?>