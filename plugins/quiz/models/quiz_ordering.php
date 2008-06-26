<?php
class QuizOrdering extends QuizAppModel {
	var $name = 'QuizOrdering';
	var $useTable = 'quiz_ordering_questions_quizzes';
	
	var $hasMany = array(
		'Answer' => array(
			'className'		=> 'Quiz.OrderingQuestionAnswer',
			'foreignKey'	=> 'ordering_questions_quiz_id',
			'dependent'		=> true,
			'conditions'	=> '',
			'fields'		=> '',
			'order'			=> '',
			'limit'			=> '',
			'offset'		=> '',
			'exclusive'		=> '',
			'finderQuery'	=> '',
			'counterQuery'	=> ''
		)
	);
	
	function saveAnswers($answers,$member_id) {
		$result = true;
		foreach ($answers as $question_id => $ordering) {
			$data = array();
			$data['Answer'] = array('member_id' => $member_id, 'ordering_questions_quiz_id' => $question_id);
			foreach ($ordering as $choice => $position) {
				$data['AnswerOrdering'][] = array('ordering_choice_id' => $choice, 'position' => $position);
			}
			if (!$result = $this->Answer->saveAll($data))
				break;
		}
		return $result;
	}
}
?>