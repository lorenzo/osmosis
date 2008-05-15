<?php
class ChoiceQuestionFixture extends CakeTestFixture {
    var $name = 'ChoiceQuestion';
 	var $table = 'quiz_choice_questions';
	var $fields = array(
			'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
			'body' => array('type'=>'text', 'null' => false),
			'shuffle' => array('type'=>'boolean', 'null' => false),
			'max_choices' => array('type'=>'integer', 'null' => false),
			'min_choices' => array('type'=>'integer', 'null' => true, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			); 
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
