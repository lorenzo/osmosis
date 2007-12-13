<?php
class TextQuestion extends AppModel {

	var $name = 'TextQuestion';
	var $validate = array(
		'title' => VALID_NOT_EMPTY,
		'body' => VALID_NOT_EMPTY,
		'format' => VALID_NOT_EMPTY,
	);

	var $useTable = 'quiz_text_questions';
	var $hasAndBelongsToMany = array(
			'Quiz' => array('className' => 'quiz.Quiz',
						'joinTable' => 'quiz_text_questions_quizzes',
						'foreignKey' => 'text_question_id',
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
