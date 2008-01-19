<?php
class ChoiceQuestionFixture extends CakeTestFixture {
    var $name = 'QuizChoiceQuestion';
 	var $import = array('model' => 'ChoiceQuestion'); 
    var $records = array(
    	array(
    		'id'		=> 'choice_question_fixture_1',
			'body'	=> 'this is the question',
			'shuffle'=> '1',
			'max_choices' =>  '2'
		)
    );
} 
?>
