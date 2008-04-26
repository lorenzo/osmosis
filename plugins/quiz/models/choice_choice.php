<?php
class ChoiceChoice extends QuizAppModel {

	var $name = 'ChoiceChoice';
	var $validate = array(
		// 'choice_question_id' => VALID_NOT_EMPTY,
		'text' => array(
			'required' => array(
				'rule' => array('custom', '/.+/')
			)
		),
		'position' => array(
			'positionLessThanTotal' => array(
				'rule' => array('positionLessThanTotal'),
				'allowEmpty' => true
			)// ,
			// 			'positionLessThanMin' => array(
			// 				'rule' => array('positionLessThanMin'),
			// 				'allowEmpty' => true
			// 			),
		)
	);

	var $useTable = 'quiz_choice_choices';

	function __construct($id = false, $table = null, $ds = null) {
		$this->setErrorMessage(
			'text.required',
			__('Please write the text for this choice',true)
		);
		$this->setErrorMessage(
			'position.positionLessThanTotal',
			__('This position is higher the total number of choices available', true)
		);
		parent::__construct($id, $table, $ds);
	}
	
	function positionLessThanTotal() {
		return (intval($this->data['ChoiceChoice']['position']) <= intval($this->data['ChoiceChoice']['total']));
	}
	
}
?>