<?php
class OrderingQuestion extends QuizAppModel {

	var $name = 'OrderingQuestion';
	var $validate = array(
		'body' => array(
		    'required' => array(
		        'rule' => array('custom','/.+/')
			),
		),
		'max_choices' => array(
			'positive' => array(
				'rule' => array('comparison', '>', 0),
				'allowEmpty' => true
			)
		),
		'min_choices' => array(
			'min_less_than_max' => array(
				'rule' => array('minLessThanMax'),
				'allowEmpty' => true
			),
			'positive' => array(
				'rule' => array('comparison', '>', 0)
			)
		)
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
		$this->setErrorMessage(
			'body.required',
			__('This field is required',true)
		);
		$this->setErrorMessage(
			'max_choices.positive',
			__('Max Choices should be greater than zero',true)
		);
		$this->setErrorMessage(
			'min_choices.min_less_than_max',
			__('Min Choices should be less than Max Choices',true)
		);
		$this->setErrorMessage(
			'min_choices.positive',
			__('Min Choices should be greater than zero',true)
		);
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
	
	function beforeValidate() {
		parent::beforeValidate();
		$positions = array_filter(Set::extract($this->data, 'OrderingChoice.{n}.position'));
		$repeated = Set::diff($positions, array_unique($positions));
		$done = $invalidOrderingChoices = array();
		$total = count($this->data['OrderingChoice']);
		foreach ($this->data['OrderingChoice'] as $i => $choice) {
			$choice['total'] = $total;
			$this->OrderingChoice->set(array('OrderingChoice' => $choice));
			$this->OrderingChoice->validates();
			$valErrors = $this->OrderingChoice->validationErrors;
			if (in_array($choice['position'], $repeated) && !in_array($choice['position'], $done)) {
				$invalidOrderingChoices[$i] = array('position' => __('This position is repeated', true));
				$done[] = $choice['position'];
				$invalidOrderingChoices[$i] = array_merge($invalidOrderingChoices[$i], $valErrors);
			} else if(!empty($valErrors)) {
				$invalidOrderingChoices[$i] = $valErrors;
			}
		}
		if (!empty($invalidOrderingChoices)) {
			$this->OrderingChoice->validationErrors = $invalidOrderingChoices;
			$this->validationErrors['OrderingChoice'] = $invalidOrderingChoices;
		}
		return true;
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
	
	function minLessThanMax() {
		if (empty($this->data['OrderingQuestion']['max_choices'])) return true;
		return intval($this->data['OrderingQuestion']['min_choices'])<=intval($this->data['OrderingQuestion']['max_choices']);
	}
}
?>