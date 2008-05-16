<?php
App::import('Component', 'PlaceholderData');

class QuizHolderComponent extends PlaceholderDataComponent {
	var $name = 'QuizHolder';
	var $auto = true;
	var $cache = false;
	var $types = array('head','course_toolbar');
	
	function head() {
		return $this->controller->plugin == 'quiz';
	}
	
	function courseToolbar() {
		return array('url' => array('plugin' => 'Quiz', 'controller' => 'quizzes', 'action' => 'index'));
	}
	
}
?>