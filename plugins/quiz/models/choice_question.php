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
class ChoiceQuestion extends QuizAppModel {

	var $name = 'ChoiceQuestion';
	var $validate = array(
		'body' => array(
			'required' => array(
				'rule' => array('custom', '/.+/')
			)
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
		),
		'num_correct' => array(
			'valid' => array(
				'rule' => array('numCorrectChoicesAvailable')
			)
		)
	);

	var $useTable = 'quiz_choice_questions';
	var $hasMany = array(
		'ChoiceChoice' => array(
			'className' => 'quiz.ChoiceChoice',
			'foreignKey' => 'choice_question_id',
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
			'joinTable' => 'quiz_choice_questions_quizzes',
			'foreignKey' => 'choice_question_id',
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
			'with' => 'QuizChoice'
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
		$this->setErrorMessage(
			'num_correct.valid',
			__('The number of correct answers is not enough compared to Min Choices',true)
		);
		parent::__construct($id, $table, $ds);
	}
	
	/**
	 * Validates the choices array before saving the question
	 *
	 * @return boolean
	 */
	
	function beforeValidate() {
		parent::beforeValidate();
		$positions = array_filter(Set::extract($this->data, 'ChoiceChoice.{n}.position'));
		$repeated = Set::diff($positions, array_unique($positions));
		$done = $invalidChoiceChoices = array();
		$total = count($this->data['ChoiceChoice']);
		
		foreach ($this->data['ChoiceChoice'] as $i => $choice) {
			$choice['total'] = $total;
			$this->ChoiceChoice->set(array('ChoiceChoice' => $choice));
			$this->ChoiceChoice->validates();
			$valErrors = $this->ChoiceChoice->validationErrors;
			if (in_array($choice['position'], $repeated) && !in_array($choice['position'], $done)) {
				$invalidChoiceChoices[$i] = array('position' => __('This position is repeated', true));
				$done[] = $choice['position'];
				$invalidChoiceChoices[$i] = array_merge($invalidChoiceChoices[$i], $valErrors);
			} elseif (!empty($valErrors)) {
				$invalidChoiceChoices[$i] = $valErrors;
			}
		}
		if (!empty($invalidChoiceChoices)) {
			$this->ChoiceChoice->validationErrors = $invalidChoiceChoices;
			$this->validationErrors['ChoiceChoice'] = $invalidChoiceChoices;
		}
		return true;
	}
	
	/**
	 * Validates taht the max_choices are greater or equal than min_choices
	 *
	 * @return void
	 * @author José Lorenzo
	 */
	
	function minLessThanMax() {
		if (empty($this->data['ChoiceQuestion']['max_choices'])) return true;
		return intval($this->data['ChoiceQuestion']['min_choices'])<=intval($this->data['ChoiceQuestion']['max_choices']);
	}
	
	/**
	 * Validates that the number of correct choices are greater or equal than the minimum coices required to be answered
	 *
	 * @return boolean
	 */
	
	function numCorrectChoicesAvailable() {
		if (empty($this->data['ChoiceQuestion']['min_choices'])) return true;
		return (intval($this->data['ChoiceQuestion']['num_correct']) >= intval($this->data['ChoiceQuestion']['min_choices']));
	}
	
	/**
	 * Shuffles the choices if necesseary
	 *
	 * @param aray $results 
	 * @param boolean $primary 
	 * @return results with shuffled choices if necessary
	 */
	
	function afterFind($results,$primary = false) {
		array_walk($results,array(&$this,'shuffleChoices'));	
		return $results;
	}
	
	/**
	 * Auxiliary function for shuffling Source and Taget choices
	 *
	 * @param array $question 
	 * @return array question with shuffled choices
	 */
	
	function shuffleChoices(&$question) {
		if (!isset($question['shuffle']) || !$question['shuffle'])
			return;

		if (isset($question['ChoiceChoice'])) {
			$new = array();
			$fixed = Set::extract($question['ChoiceChoice'], '{n}.position');
			$open = array_keys($fixed);
			foreach ($fixed as $i => $index) {
				if ($index<=0) {
					continue;
				}
				$index -= 1;
				$new[$index] = $question['ChoiceChoice'][$i];
				unset($open[$index]);
				unset($question['ChoiceChoice'][$i]);
			}
			shuffle($open);
			foreach ($open as $i => $index) {
				$new[$index] = array_pop($question['ChoiceChoice']);
			}
			ksort($new);
			$question['ChoiceChoice'] = $new;
		}
	}
}
?>
