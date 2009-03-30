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
		)
	);
}
?>