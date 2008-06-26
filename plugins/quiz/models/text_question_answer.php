<?php
class TextQuestionAnswer extends QuizAppModel {
	var $name = 'TextQuestionAnswer';
	var $useTable = 'quiz_text_questions_answers';
	var $actsAs = array('Loggable');
	
	var $belongsTo = array(
		'Member' => array(
			'className'		=> 'Member',
			'foreignKey'	=> 'member_id',
			'conditions'	=> '',
			'fields'		=> array('id','username', 'full_name'),
			'order'			=> ''
		),
		'TextQuestion' => array(
			'className'		=> 'Quiz.TextQuestion',
			'foreignKey'	=> 'text_questions_quiz_id',
			'conditions'	=> '',
			'fields'		=> '',
			'order'			=> ''
		)
	);
}
?>