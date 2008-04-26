<?php
class OrderingChoice extends QuizAppModel {

	var $name = 'OrderingChoice';
	var $validate = array(
		'text' => array(
			'required' => array(
				'rule' => array('custom', '/.+/')
			)
		),
		'position' => array(
			'positive' => array(
				'rule' => array('comparison', '>', 0),
				'allowEmpty' => true
			),
			'positionOk' => array(
				'rule' => array('positionOk'),
				'allowEmpty' => true
			)
		)
	);

	var $useTable = 'quiz_ordering_choices';
	var $belongsTo = array(
		'OrderingQuestion' => array(
			'className' => 'quiz.OrderingQuestion',
			'foreignKey' => 'ordering_question_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => ''
		)
	);
	
	function __construct($id = false, $table = null, $ds = null) {
		$this->setErrorMessage(
			'text.required',
			__('This field is required',true)
		);
		$this->setErrorMessage(
			'position.positive',
			__('Position should be greater than zero', true)
		);
		$this->setErrorMessage(
			'position.positionOk',
			__('This position is higher the total number of choices available', true)
		);
		parent::__construct($id,$table,$ds);
	}
	
	function positionOk() {
		return (intval($this->data['OrderingChoice']['position']) <= intval($this->data['OrderingChoice']['total']));
	}
}
?>
