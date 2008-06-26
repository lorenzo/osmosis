<?php
class QuizMatching extends QuizAppModel {
	var $name = 'QuizMatching';
	var $useTable = 'quiz_matching_questions_quizzes';
	
	var $hasMany = array(
		'Answer' => array(
			'className'		=> 'Quiz.MatchingQuestionAnswer',
			'foreignKey'	=> 'matching_questions_quiz_id',
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
		foreach ($answers as $question_id => $matchings) {
			$data = array();
			$data['Answer'] = array('member_id' => $member_id, 'matching_questions_quiz_id' => $question_id);
			foreach ($matchings['answer'] as $source => $targetNumber) {
				if (!empty($source) && isset($matchings['TargetChoice'][$targetNumber]))
					$data['AnswerMatching'][] = array('source_id' => $source, 'target_id' => $matchings['TargetChoice'][$targetNumber]);
			}
			if (!$result = $this->Answer->saveAll($data))
				break;
		}
		return $result;
	}
}
?>