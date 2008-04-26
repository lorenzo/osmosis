<?php
class OrderingChoice extends QuizAppModel {

	var $name = 'OrderingChoice';
	var $validate = array(
		'text' => array(
			'required_with_position' => array(
				'rule' => array('positionOk')
			)
		)
		// ,
		// 		'position' => array(
		// 			'position_ok' => array(
		// 				'rule' => array('positionOk'),
		// 				'message' => 'The position must be between zero and the number of choices written',
		// 				'allowEmpty' => true
		// 			)
		// 		)
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
		if (empty($this->data['OrderingChoice']['text'])) {
			return false;
		}
		if (empty($this->data['OrderingChoice']['position'])) {
			return true;
		}
		
		return (intval($this->data['OrderingChoice']['position'])<=intval($this->data['OrderingChoice']['total']));
	}
}
?>
