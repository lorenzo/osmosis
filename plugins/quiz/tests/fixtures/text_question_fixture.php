<?php
class TextQuestionFixture extends CakeTestFixture {
	var $name = 'QuizTextQuestion';
	var $import = array('model' => 'TextQuestion'); 
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
