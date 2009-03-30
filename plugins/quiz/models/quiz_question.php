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
	
	function getLastPostion($quiz_id) {
		$result = $this->find('first',array(
				'fields' => array('MAX(position) AS last'),
				'conditions' => array('quiz_id' => $quiz_id),
				'recursive' => -1
			)
		);
		return $result[0]['last'];
	}
	
	function beforeSave() {
		if (!isset($this->data[$this->alias]['position']) && isset($this->data[$this->alias]['quiz_id'])) {
			$lastPosition = $this->getLastPostion($this->data[$this->alias]['quiz_id']);
			$this->data[$this->alias]['position'] = $lastPosition + 1;
		}
		return true;
	}
	
}
?>