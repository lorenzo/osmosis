<?php
class MatchingQuestionFixture extends CakeTestFixture {
	var $name = 'QuizMatchingQuestion';
	var $import = array('model' => 'MatchingQuestion'); 
	var $records = array(
		array(
			'id'		=> 'matching_from_fixture1',
			'shuffle'=> '1',
    		'body'	=> 'matching text body'
		)
	);
}
?>
