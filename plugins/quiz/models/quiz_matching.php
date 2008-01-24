<?php
class QuizMatching extends QuizAppModel {
	var $name = 'QuizMatching';
	var $belongsTo = array(
		'quiz.Quiz', 'quiz.MatchingQuestion'
	);
	
	
}
?>