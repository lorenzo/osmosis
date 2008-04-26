<?php
class OrderingQuestion extends QuizAppModel {

	var $name = 'OrderingQuestion';
	var $validate = array(
		'body' => array(
		    'Error.empty' => array(
		        'rule' => array( 'custom','/.+/')
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
		'Quiz' => array(
			'className' => 'quiz.Quiz',
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
			'insertQuery' => '',
			'with' => 'QuizOrdering'
		)
	);
	
	function __construct($id = false, $table = null, $ds = null) {
			$this->validate['body']['Error.empty']['message'] = __('The body can not be empty',true);
			$this->validate['shuffle']['Error.empty']['message'] = __('Suffle can not be empty',true);
			$this->validate['max_choices']['Error.empty']['message'] = __('Max_choices can not be empty',true);
			parent::__construct($id,$table,$ds);
	}
	
	/**
	 * Prepares each Question's choices shuffling.
	 *
	 * @param array $results
	 * @param string $primary 
	 * @return questions with choices shuffled.
	 * @author Joaquín Windmüller
	 */
	
	function afterFind($results, $primary=false) {
		if ($primary) {
			foreach ($results as $i => $result) {
				if (!isset($result['OrderingChoice'])) {
					break;
				}
				$shuffle = $result['OrderingQuestion']['shuffle'];
				$choices = $result['OrderingChoice'];
				if ($shuffle) {
					$results[$i]['OrderingChoice'] = $this->_shuffleChoices($choices);
				}
			}
		} else {
			foreach ($results as $i => $result) {
				if (isset($result['OrderingQuestion'])) {
					if (empty($result['OrderingQuestion'])) return $result;
					$shuffle = $result['OrderingQuestion'][0]['shuffle'];
					$choices = $result['OrderingQuestion'][0]['OrderingChoice'];
				} else {
					$shuffle = $result['shuffle'];
					$choices = $result['OrderingChoice'];
				}
				if ($shuffle) {
					if (isset($result['OrderingQuestion'])) {
						$results[$i]['OrderingQuestion'][0]['OrderingChoice'] = $this->_shuffleChoices($choices);
					} else {
						$results[$i]['OrderingChoice'] = $this->_shuffleChoices($choices);
					}
				}
			}
		}
		return $results;
	}
	
	/**
	 * Shuffles a set of choices, taking in account the fixed position set on some of them.
	 *
	 * @param array $choices set of choices to shuffle.
	 * @return array shuffled choices 
	 * @author Joaquín Windmüller
	 */
	function _shuffleChoices($choices) {
		$new = array();
		$fixed = Set::extract($choices, '{n}.position');
		$open = array_keys($fixed);
		foreach ($fixed as $i => $index) {
			if ($index<=0) {
				continue;
			}
			$index -= 1;
			$new[$index] = $choices[$i];
			unset($open[$index]);
			unset($choices[$i]);
		}
		shuffle($open);
		foreach ($open as $i => $index) {
			$new[$index] = array_pop($choices);
		}
		ksort($new);
		return $new;
	}
}
?>