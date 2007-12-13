<?php
class AssociationChoice extends AppModel {

	var $name = 'AssociationChoice';
	var $validate = array(
		'association_question_id' => VALID_NOT_EMPTY,
		'text' => VALID_NOT_EMPTY,
	);

	var $useTable = 'quiz_association_choices';
	var $belongsTo = array(
			'AssociationQuestion' => array(
								'className' => 'quiz.AssociationQuestion',
								'foreignKey' => 'association_question_id',
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'counterCache' => ''),
	);

}
?>
