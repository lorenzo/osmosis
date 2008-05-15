<?php
class OrderingQuestionFixture extends CakeTestFixture {
	var $name = 'QuizOrderingQuestion';
	var $table = 'quiz_ordering_questions';
	var $fields = array(
			'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
			'body' => array('type'=>'text', 'null' => false),
			'shuffle' => array('type'=>'boolean', 'null' => false),
			'max_choices' => array('type'=>'integer', 'null' => false, 'default' => '0', 'length' => 4),
			'min_choices' => array('type'=>'integer', 'null' => false, 'default' => '0', 'length' => 4),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $records = array(
		array(
			'id'		=> 'ordering_from_fixture1',
			'shuffle'=> '1',
    		'body'	=> 'ordering text body'
		)
	);
}
?>
