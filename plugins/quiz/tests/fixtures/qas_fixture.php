<?php
class QasFixture extends CakeTestFixture {
    var $name = 'QuizAssociationQuestionsQuizzes';
 	var $import = array('table' => 'quiz_association_questions_quizzes'); 
    var $records = array(
    	array(
    		'quiz_id'	=> 	'q1',
    		'association_question_id'	=> 'aq1'
		)
    );
} 
?>
