<?php
class MatchingQuestionFixture extends CakeTestFixture {
	var $name = 'QuizMatchingQuestion';
	var $table = 'quiz_matching_questions';
	var $fields = array(
			'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
			'body' => array('type'=>'text', 'null' => false),
			'shuffle' => array('type'=>'boolean', 'null' => false),
			'max_associations' => array('type'=>'integer', 'null' => false, 'default' => '0', 'length' => 3),
			'min_associations' => array('type'=>'integer', 'null' => false, 'default' => '0', 'length' => 3),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $records = array(
		array(
			'id'		=> 'matching_from_fixture1',
			'shuffle'=> '1',
    		'body'	=> 'matching text body'
		)
	);
}
?>
