<?php
class QuizChoice extends QuizAppModel {
	var $name = 'QuizChoice';
	var $belongsTo = array(
		'quiz.Quiz', 'quiz.ChoiceQuestion'
	);
	
	
}
?>