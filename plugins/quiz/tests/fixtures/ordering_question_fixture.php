<?php
class OrderingQuestionFixture extends CakeTestFixture {
	var $name = 'QuizOrderingQuestion';
	var $import = array('model' => 'OrderingQuestion'); 
	var $records = array(
		array(
			'id'		=> 'ordering_from_fixture1',
			'shuffle'=> '1',
    		'body'	=> 'ordering text body'
		)
	);
}
?>
