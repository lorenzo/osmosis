<?php
class QuizOrderingFixture extends CakeTestFixture {
	var $name = 'QuizOrderingQuestionsQuizzes';
	var $import = array('table' => 'quiz_ordering_questions_quizzes'); 
	var $records = array(
		array(
			'quiz_id'				=> 'quiz1_from_fixture',
			'ordering_question_id'	=> 'ordering_from_fixture1'
		)
	);
}
?>