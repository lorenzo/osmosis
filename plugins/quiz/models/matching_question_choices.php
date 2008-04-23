<?php
class MatchingQuestionChoices extends QuizAppModel {
	var $name = 'MatchingQuestionChoices';
	
	var $belongsTo = array(
		'quiz.MatchingQuestion', 'quiz.MatchingChoice'
	);
	
}

?>