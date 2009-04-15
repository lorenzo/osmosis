<?php
class OrderingQuestionAnswer extends AppModel {
	var $name = "OrderingQuestionAnswer";
	var $useTable = 'quiz_ordering_questions_answers';
	
	var $belongsTo = array(
		'Member' => array(
			'className'		=> 'Member',
			'foreignKey'	=> 'member_id',
			'conditions'	=> '',
			'fields'		=> array('id','username', 'full_name'),
			'order'			=> ''
		)
	);
	
	var $hasMany = array(
		'AnswerOrdering' => array(
			'className'		=> 'Quiz.OrderingAnswer',
			'foreignKey'	=> 'ordering_questions_answer_id',
			'dependent'		=> true,
		),
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