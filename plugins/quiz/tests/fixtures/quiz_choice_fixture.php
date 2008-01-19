<?php
class QuizChoiceFixture extends CakeTestFixture {
	var $name = 'QuizChoiceQuestionsQuizzes';
	var $import = array('table' => 'quiz_choice_questions_quizzes'); 
	var $records = array(
		array(
			'quiz_id' => 'quiz1_from_fixture',
			'choice_question_id' => 'choice_question_fixture_1'
		)
	);
} 
?>
