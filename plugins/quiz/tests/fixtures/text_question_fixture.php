<?php
class TextQuestionFixture extends CakeTestFixture {
	var $name = 'TextQuestion';
	var $table = 'quiz_text_questions';
	var $fields = array(
			'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
			'title' => array('type'=>'string', 'null' => false),
			'body' => array('type'=>'text', 'null' => false),
			'format' => array('type'=>'string', 'null' => false, 'length' => 5),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $records = array(
		array(
			'id'		=> 'text_from_fixture1',
    		'body'	=> 'Text Question Body',
			'title'	=> 'Text Question Title',
			'format'	=> 'xhtml'
		)
	);
}
?>
