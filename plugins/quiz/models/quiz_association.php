<?php
class QuizAssociation extends QuizAppModel {
	var $name = 'QuizAssociation';
	var $belongsTo = array(
		'quiz.Quiz', 'quiz.AssociationQuestion'
	);
	
	
}
?>