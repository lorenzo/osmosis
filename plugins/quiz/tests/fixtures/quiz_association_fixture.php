<?php
class QuizAssociationFixture extends CakeTestFixture {
    var $name = 'QuizAssociationQuestionsQuizzes';
 	var $import = array('table' => 'quiz_association_questions_quizzes'); 
    var $records = array(
    	array(
    		'quiz_id'	=> 	'quiz1_from_fixture',
    		'association_question_id'	=> 'aq_from_fixture1'
		)
    );
} 
?>
