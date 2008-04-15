<?php
class OrderingQuestion extends QuizAppModel {

	var $name = 'OrderingQuestion';
	var $validate = array(
		'body' => array(
		    'Error.empty' => array(
		        'rule' => array( 'custom','/.+/'),
				),
		),
		'shuffle' => array(
		    'Error.empty' => array(
		        'rule' => array( 'custom','/.+/'),
				),
		),
		'max_choices' => array(
		    'Error.empty' => array(
		        'rule' => array( 'custom','/.+/'),
				),
		),
	);

	var $useTable = 'quiz_ordering_questions';
	var $hasMany = array(
		'OrderingChoice' => array(
			'className' => 'quiz.OrderingChoice',
			'foreignKey' => 'ordering_question_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'dependent' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	var $hasAndBelongsToMany = array(
			'Quiz' => array('className' => 'quiz.Quiz',
						'joinTable' => 'quiz_ordering_questions_quizzes',
						'foreignKey' => 'ordering_question_id',
						'associationForeignKey' => 'quiz_id',
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
	
	function __construct($id = false, $table = null, $ds = null) {
			$this->validate['body']['Error.empty']['message'] = __('The body can not be empty',true);
			$this->validate['shuffle']['Error.empty']['message'] = __('Suffle can not be empty',true);
			$this->validate['max_choices']['Error.empty']['message'] = __('Max_choices can not be empty',true);
			parent::__construct($id,$table,$ds);
	}

}
?>
