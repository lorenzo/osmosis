<?php
class ClozeQuestionFixture extends CakeTestFixture {
	var $name = 'QuizClozeQuestion';
	var $import = array('model' => 'ClozeQuestion'); 
	var $records = array(
		array(
			'id'		=> 'cloze_from_fixture1',
			'title'	=> 'Cloze Question 1',
    		'body'	=> 'cloze text body'
		)
	);
}
?>
