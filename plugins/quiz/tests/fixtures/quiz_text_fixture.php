<?php
class QuizTextFixture extends CakeTestFixture {
	var $name = 'QuizTextQuestionsQuizzes';
	var $import = array('table' => 'quiz_text_questions_quizzes'); 
	var $records = array(
		array(
			'quiz_id'				=> 'quiz1_from_fixture',
			'text_question_id'	=> 'text_from_fixture1'
		)
	);
}
?>