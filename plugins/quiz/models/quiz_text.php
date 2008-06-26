<?php
class QuizText extends QuizAppModel {
	var $name = 'QuizText';
	var $useTable = 'quiz_text_questions_quizzes';
	
	var $hasMany = array(
		'Answer' => array(
			'className'		=> 'Quiz.TextQuestionAnswer',
			'foreignKey'	=> 'text_questions_quiz_id',
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
		foreach ($answers as $question_id => $answer) {
			$data = array();
			$data['Answer'] = array('member_id' => $member_id, 'text_questions_quiz_id' => $question_id,'answer' => $answer['answer']);
			if (!$result = $this->Answer->save($data))
				break;
		}
		return $result;
	}
}
?>