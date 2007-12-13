<?php
class OrderingQuestion extends AppModel {

	var $name = 'OrderingQuestion';
	var $validate = array(
		'body' => VALID_NOT_EMPTY,
		'shuffle' => VALID_NOT_EMPTY,
		'max_choices' => VALID_NOT_EMPTY,
	);

	var $useTable = 'quiz_ordering_questions';
	var $hasMany = array(
			'OrderingChoice' => array('className' => 'quiz.OrderingChoice',
								'foreignKey' => 'ordering_question_id',
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'dependent' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''),
	);

	var $hasAndBelongsToMany = array(
			'Quiz' => array('className' => 'quiz.Quiz',
						'joinTable' => 'quiz_ordering_questions_quizzes',
						'foreignKey' => 'ordering_question_id',
						'associationForeignKey' => 'quiz_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'unique' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''),
	);

}
?>
