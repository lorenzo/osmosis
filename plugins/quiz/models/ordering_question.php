<?php
/* SVN FILE: $Id$ */
/**
 * Ósmosis LMS: <http://www.osmosislms.org/>
 * Copyright 2008, Ósmosis LMS
 *
 * This file is part of Ósmosis LMS.
 * Ósmosis LMS is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Ósmosis LMS is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Ósmosis LMS.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @filesource
 * @copyright		Copyright 2008, Ósmosis LMS
 * @link			http://www.osmosislms.org/
 * @package			org.osmosislms
 * @subpackage		org.osmosislms.app
 * @since			Version 2.0 
 * @version			$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 * @license			http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License Version 3
 */
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
	 * Shuffles the choices if necesseary
	 *
	 * @param aray $results 
	 * @param boolean $primary 
	 * @return results with shuffled choices if necessary
	 */
	
	function afterFind($results,$primary = false) {
		if (isset($results['OrderingChoice']))
			array_walk($results,array(&$this,'shuffleChoices'));	
		return $results;
	}
	
	/**
	 * Validates ordering options before saving the question
	 *
	 * @return boolean true if all ordering options are valid
	 */
	
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
	 */
	function shuffleChoices(&$question) {
		if (!isset($question['shuffle']) || !$question['shuffle'])
			return;

		if (isset($question['OrderingChoice'])) {
			$new = array();
			$fixed = Set::extract($question['OrderingChoice'], '{n}.position');
			$open = array_keys($fixed);
			foreach ($fixed as $i => $index) {
				if ($index<=0) {
					continue;
				}
				$index -= 1;
				$new[$index] = $question['OrderingChoice'][$i];
				unset($open[$index]);
				unset($question['OrderingChoice'][$i]);
			}
			shuffle($open);
			foreach ($open as $i => $index) {
				$new[$index] = array_pop($question['OrderingChoice']);
			}
			ksort($new);
			$question['OrderingChoice'] = $new;
		}
	}
	
	/**
	 * Validates that max_choices is greater that min_choices
	 *
	 * @return boolean
	 */
	
	function minLessThanMax() {
		if (empty($this->data['OrderingQuestion']['max_choices'])) return true;
		return intval($this->data['OrderingQuestion']['min_choices'])<=intval($this->data['OrderingQuestion']['max_choices']);
	}
}
?>
