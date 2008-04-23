<?php
class OrderingChoice extends QuizAppModel {

	var $name = 'OrderingChoice';
	var $validate = array(
		'text' => array(
			'required_with_position' => array(
				'rule' => array('/.+/'),
				'message' => 'Please write a text for this choice'
			)
		),
		'position' => array(
			'position_ok' => array(
				'rule' => array('positionOk'),
				'message' => 'The position must be between zero and the number of choices written',
				'allowEmpty' => true
			)
		)
	);

	var $useTable = 'quiz_ordering_choices';
	var $belongsTo = array(
			'OrderingQuestion' => array('className' => 'quiz.OrderingQuestion',
								'foreignKey' => 'ordering_question_id',
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'counterCache' => ''),
	);
	
	function positionOk() {
		return ($this->data['OrderingChoice']['total']<$this->data['OrderingChoice']['position']);
	}
}
?>
