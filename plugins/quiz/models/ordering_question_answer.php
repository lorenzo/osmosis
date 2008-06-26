<?php
class OrderingQuestionAnswer extends AppModel {
	var $name = "OrderingQuestionAnswer";
	var $useTable = 'quiz_ordering_questions_answers';
	
	var $belongsTo = array(
		'Member' => array(
			'className'		=> 'Member',
			'foreignKey'	=> 'member_id',
			'conditions'	=> '',
			'fields'		=> array('id','username', 'full_name'),
			'order'			=> ''
		),
		'OrderingQuestion' => array(
			'className'		=> 'Quiz.OrderingQuestion',
			'foreignKey'	=> 'ordering_questions_quiz_id',
			'conditions'	=> '',
			'fields'		=> '',
			'order'			=> ''
		)
	);
	
	var $hasMany = array(
		'AnswerOrdering' => array(
			'className'		=> 'Quiz.OrderingAnswer',
			'foreignKey'	=> 'ordering_questions_answer_id',
			'dependent'		=> true,
		),
	);
}
?>