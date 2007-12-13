<?php
class Quiz extends AppModel {

	var $name = 'Quiz';
	var $validate = array(
		'name' =>  array(
			'rule' => VALID_NOT_EMPTY,
			'message' => 'quiz.quiz.name.empty',
			'required' => true,
			'allowEmpty' => false
		),
	);

	var $useTable = 'quiz_quizzes';
	var $hasAndBelongsToMany = array(
			'AssociationQuestion' => array(
						'className' => 'quiz.AssociationQuestion',
						'joinTable' => 'quiz_association_questions_quizzes',
						'foreignKey' => 'quiz_id',
						'associationForeignKey' => 'association_question_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'unique' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''),
			'ChoiceQuestion' => array(
						'className' => 'quiz.ChoiceQuestion',
						'joinTable' => 'quiz_choice_questions_quizzes',
						'foreignKey' => 'quiz_id',
						'associationForeignKey' => 'choice_question_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'unique' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''),
			'ClozeQuestion' => array(
						'className' => 'quiz.ClozeQuestion',
						'joinTable' => 'quiz_cloze_questions_quizzes',
						'foreignKey' => 'quiz_id',
						'associationForeignKey' => 'cloze_question_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'unique' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''),
			'MatchingQuestion' => array(
						'className' => 'quiz.MatchingQuestion',
						'joinTable' => 'quiz_matching_questions_quizzes',
						'foreignKey' => 'quiz_id',
						'associationForeignKey' => 'matching_question_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'unique' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''),
			'OrderingQuestion' => array('className' => 'quiz.OrderingQuestion',
						'joinTable' => 'quiz_ordering_questions_quizzes',
						'foreignKey' => 'quiz_id',
						'associationForeignKey' => 'ordering_question_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'unique' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''),
			'TextQuestion' => array(
						'className' => 'quiz.TextQuestion',
						'joinTable' => 'quiz_text_questions_quizzes',
						'foreignKey' => 'quiz_id',
						'associationForeignKey' => 'text_question_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'unique' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''),
	);

}
?>
