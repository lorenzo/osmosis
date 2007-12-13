<?php
class MatchingChoice extends AppModel {

	var $name = 'MatchingChoice';
	var $validate = array(
		'matching_question_id' => VALID_NOT_EMPTY,
		'text' => VALID_NOT_EMPTY,
		'source' => VALID_NOT_EMPTY,
	);

	var $useTable = 'quiz_matching_choices';
	var $belongsTo = array(
			'MatchingQuestion' => array('className' => 'quiz.MatchingQuestion',
								'foreignKey' => 'matching_question_id',
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'counterCache' => ''),
	);

}
?>
