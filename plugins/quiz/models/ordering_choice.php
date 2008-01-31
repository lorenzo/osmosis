<?php
class OrderingChoice extends QuizAppModel {

	var $name = 'OrderingChoice';
	var $validate = array(
		'ordering_question_id' => VALID_NOT_EMPTY,
		'text' => VALID_NOT_EMPTY,
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

}
?>
