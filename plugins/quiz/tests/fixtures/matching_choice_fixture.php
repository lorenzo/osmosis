<?php
class MatchingChoiceFixture extends CakeTestFixture {
	var $name = 'QuizMatchingChoice';
	var $import = array('model' => 'MatchingChoice'); 
	var $records = array(
		array(
			'id'		=> 'matching_choice_fixture1',
    		'text'	=> 'this should be the source'
		),
		array(
			'id'		=> 'matching_choice_fixture2',
    		'text'	=> 'this should be the target'
		)
		
	);
}
?>
