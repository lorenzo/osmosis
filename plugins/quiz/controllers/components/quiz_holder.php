<?php
App::import('Component', 'PlaceholderData');

class QuizHolderComponent extends PlaceholderDataComponent {
	var $name = 'QuizHolder';
	var $auto = true;
	var $types = array('head','course_toolbar');
	
	function getData($type = null) {
		if ($type == 'course_toolbar')
			return array('url' => array('plugin' => 'quiz', 'controller' => 'quizzes', 'action' => 'index'));
		elseif ($type == 'head')
			return true;
		
		return false;
	}
}
?>