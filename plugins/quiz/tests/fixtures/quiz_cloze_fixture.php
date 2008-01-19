<?php
class QuizClozeFixture extends CakeTestFixture {
	var $name = 'QuizClozeQuestionsQuizzes';
	var $import = array('table' => 'quiz_cloze_questions_quizzes'); 
	var $records = array(
		array(
			'quiz_id'				=> 'quiz1_from_fixture',
			'cloze_question_id'	=> 'cloze_from_fixture1'
		)
	);
}
?>