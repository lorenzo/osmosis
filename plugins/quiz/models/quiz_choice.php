<?php
class QuizChoice extends QuizAppModel {
	var $name = 'QuizChoice';
	var $useTable = 'quiz_choice_questions_quizzes';
	
	var $hasMany = array(
		'Answer' => array(
			'className'		=> 'Quiz.ChoiceQuestionAnswer',
			'foreignKey'	=> 'choice_questions_quiz_id',
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
		foreach ($answers as $question_id => $selectedChoices) {
			$data = array();
			$data['Answer'] = array('member_id' => $member_id, 'choice_questions_quiz_id' => $question_id);
			if (is_array($selectedChoices)) {
				foreach ($selectedChoices as $choice) {
					$data['AnswerChoice'][] = array('choice_choice_id' => $choice);
				}
			} else {
				$data['AnswerChoice'][] =  array('choice_choice_id' => $selectedChoices);
			}
			if (!$result = $this->Answer->saveAll($data))
				break;
		}
		return $result;
	}
}
?>