<?php
class ClozeQuestion extends AppModel {

	var $name = 'ClozeQuestion';
	var $validate = array(
		'title' => VALID_NOT_EMPTY,
		'body' => VALID_NOT_EMPTY,
	);

	var $useTable = 'quiz_cloze_questions';
	var $hasAndBelongsToMany = array(
			'Quiz' => array(
				'className' => 'quiz.Quiz',
				'joinTable' => 'quiz_cloze_questions_quizzes',
				'foreignKey' => 'cloze_question_id',
				'associationForeignKey' => 'quiz_id',
				'with' => 'QuizCloze'
			),
	);

}
?>
