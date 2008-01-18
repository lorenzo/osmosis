<?php
class AssociationChoiceFixture extends CakeTestFixture {
    var $name = 'QuizAssociationChoice';
 	var $import = array('model' => 'AssociationChoice'); 
    var $records = array(
    	array(
    		'association_question_id'	=> 	'aq_from_fixture1',
    		'text'	=> 'texto de la pregunta de asoc'
		)
    );
} 
?>
