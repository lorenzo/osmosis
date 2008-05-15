<?php
class QuizFixture extends CakeTestFixture {
    var $name = 'Quiz';
 	var $table = 'quiz_quizzes';
	var $fields = array(
			'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
			'name' => array('type'=>'string', 'null' => false),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
    var $records = array(
    	array(
    		'id'	=> 	'quiz1_from_fixture',
    		'name'	=> 'quiz 1'
		)
    );
} 
?>
