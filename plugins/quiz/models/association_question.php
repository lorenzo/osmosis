<?php
class AssociationQuestion extends QuizAppModel {

	var $name = 'AssociationQuestion';
	var $validate = array(
		'body' => VALID_NOT_EMPTY,
		'shuffle' => VALID_NOT_EMPTY,
		'max_associations' => VALID_NOT_EMPTY,
	);

	var $useTable = 'quiz_association_questions';
	var $hasMany = array(
			'AssociationChoice' => array(
								'className' => 'quiz.AssociationChoice',
								'foreignKey' => 'association_question_id',
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'dependent' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''),
	);

	var $hasAndBelongsToMany = array(
			'Quiz' => array(
				'className' => 'quiz.Quiz',
				'joinTable' => 'quiz_association_questions_quizzes',
				'foreignKey' => 'association_question_id',
				'associationForeignKey' => 'quiz_id',
				'with' => 'Qas'
			)
	);

}
?>
