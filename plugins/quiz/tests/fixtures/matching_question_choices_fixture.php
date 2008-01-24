<?php
class MatchingQuestionChoicesFixture extends CakeTestFixture {
	var $name = 'QuizMatchingChoicesMatchingQuestion';
	var $import = array('table' => 'quiz_matching_choices_matching_questions'); 
	var $records = array(
		array(
			'matching_question_id'	=> 'matching_from_fixture1',
			'source' => 'matching_choice_fixture1',
			'target' => 'matching_choice_fixture2'
		)
	);
}
?>