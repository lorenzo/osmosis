<?php
App::import('Component', 'PlaceholderData');

class QuizHeadHolderComponent extends PlaceholderDataComponent {
	var $name = 'QuizHead';
	var $type = 'head';
	var $auto = true;
	
	function getData() {
		return array('quiz');
	}
}
?>