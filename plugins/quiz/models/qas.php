<?php
class Qas extends QuizAppModel {
	var $name = 'Qas';
	var $belongsTo = array(
		'quiz.Quiz', 'quiz.AssociationQuestion'
	);
	
	
}
?>