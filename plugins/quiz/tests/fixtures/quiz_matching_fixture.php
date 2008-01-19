<?php
class QuizMatchingFixture extends CakeTestFixture {
	var $name = 'QuizMatchingQuestionsQuizzes';
	var $import = array('table' => 'quiz_matching_questions_quizzes'); 
	var $records = array(
		array(
			'quiz_id'				=> 'quiz1_from_fixture',
			'matching_question_id'	=> 'matching_from_fixture1'
		)
	);
}
?>