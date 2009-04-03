<?php
class QuizQuestion extends QuizAppModel {
	var $name = 'QuizQuestion';
	var $useTable = 'quiz_questions_quizzes';
	/**
	 * BelongsTo (1-N) relation descriptors
	 *
	 * @var array
	 **/
	var $belongsTo = array(
		'Quiz' => array(
			'className' => 'Quiz.Quiz',
			'foreignKey' => 'quiz_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => ''
		),
		'Question' => array(
			'className' => 'Quiz.Question',
			'foreignKey' => 'question_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => ''
		)
	);

	var $actsAs = array('Quiz.Sortable' => array('field' => 'position'));
	
}
?>
