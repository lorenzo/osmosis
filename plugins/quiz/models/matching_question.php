
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
class MatchingQuestion extends QuizAppModel {

	var $name = 'MatchingQuestion';
	var $validate = array(
		'body' => array(
			'required' => array(
				'rule' => array('/.+/'),
				'required' => true,
				'allowEmpty' => false
			)
		),
		'max_associations' => array(
			'natural' => array(
				'rule' => array('custom','/[0-9]+/'),
				'required' => false,
				'allowEmpty' => true
			),
			'nonzero' => array(
				'rule' => array('comparison','>',0),
			),
		),
		'min_associations' => array(
			'natural' => array(
				'rule' => array('custom','/[0-9]+/'),
				'required' => false,
				'allowEmpty' => true
			),
			'minimum' => array(
				'rule' => array('validMinAssocs'),
			),
			'bound' => array(
				'rule' => array('validBoundMinAssocs'),
			),
		)
	);

	var $useTable = 'quiz_matching_questions';

	var $hasMany = array(
		'SourceChoice' => array(
			'className' => 'quiz.MatchingChoice',
			'foreignKey' => 'matching_question_id',
			'conditions' => 'target_id IS NOT NULL',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'dependent' => true,
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'TargetChoice' => array(
			'className' => 'quiz.MatchingChoice',
			'foreignKey' => 'matching_question_id',
			'conditions' => 'target_id IS NULL',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'dependent' => true,
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
	);
	var $hasAndBelongsToMany = array(
			'Quiz' => array(
				'className' => 'quiz.Quiz',
				'joinTable' => 'quiz_matching_questions_quizzes',
				'foreignKey' => 'matching_question_id',
				'associationForeignKey' => 'quiz_id',
				'with' => 'Quiz.QuizMatching'
			)
	);
	
	function __construct($id = false, $table = null, $ds = null) {
		$this->setErrorMessage(
			'body.required',
			__('This field is required',true)
		);
		$this->setErrorMessage(
			'max_associations.nonzero',
			__('Max Associations should be greater than zero',true)
		);
		$this->setErrorMessage(
			'max_associations.natural',
			__('Max Associations should be a number',true)
		);
		$this->setErrorMessage(
			'min_associations.natural',
			__('Min Associations should be a number',true)
		);
		$this->setErrorMessage(
			'min_associations.minimum',
			__('Min Associations should be less than Max Associations',true)
		);
		$this->setErrorMessage(
			'min_associations.bound',
			__('The number of correct answers is not enough compared to Min Associations',true)
		);
		parent::__construct($id, $table, $ds);
	}
	
	/**
	 * Validates that the minimum associations requested to be made are less or equal than the number of target choices
	 *
	 * @return boolean
	 */
	
	function validMinAssocs() {
		return intval($this->data[$this->alias]['min_associations']) <= intval($this->data[$this->alias]['max_associations']);
	}
	
	/**
	 * Validates that the minimum associations requested to be made are less or equal than the number of source choices
	 *
	 * @return boolean
	 */
	
	function validBoundMinAssocs() {
		return $this->data[$this->alias]['min_associations'] <= count($this->data['SourceChoice']);
	}

	/**
	 * Validates the matching choices before saving the question
	 *
	 * @return boolean
	 */
	
	function beforeValidate() {
		parent::beforeValidate();
		
		if(!isset($this->data['SourceChoice']) || !isset($this->data['TargetChoice']))
			return false;
		
		$sourceSet = $this->data['SourceChoice'];
		$targetSet = $this->data['TargetChoice'];
		
		$invalidSourceChoices = array();
		foreach ($this->data['SourceChoice'] as $i => $d) {
			$this->SourceChoice->set($d);
			$this->SourceChoice->validates();
			if($this->SourceChoice->validationErrors) {
				$invalidSourceChoices[$i] = $this->SourceChoice->validationErrors;
			} elseif ($d['correct'] > count($targetSet)) {
				$invalidSourceChoices[$i] = array('text' => __('Invalid number for correct answer',true));
			}
						
		}
		$invalidTargetChoices = array();
		foreach ($this->data['TargetChoice'] as $i => $d) {
			$this->TargetChoice->set($d);
			$this->TargetChoice->validates();
			if($this->TargetChoice->validationErrors) {
				$invalidTargetChoices[$i] = $this->TargetChoice->validationErrors;
			}			
		}
		
		if (!empty($invalidSourceChoices)) {
			$this->SourceChoice->validationErrors = $invalidSourceChoices;
			$this->validationErrors['SourceChoice'] = $invalidSourceChoices;
		}

		if (!empty($invalidTargetChoices)) {
			$this->TargetChoice->validationErrors = $invalidTargetChoices;
			$this->validationErrors['TargetChoice'] = $invalidTargetChoices;
		}
		
		return true;
	}
	
	/**
	 * Shuffles the choices if necesseary
	 *
	 * @param aray $results 
	 * @param boolean $primary 
	 * @return results with shuffled choices if necessary
	 */
	
	function afterFind($results,$primary = false) {
		if (isset($question['SourceChoice']) && isset($question['TargetChoice']))
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
			
		if (isset($question['SourceChoice'])) {
			shuffle($question['SourceChoice']);
		}
		
		if (isset($question['TargetChoice'])) {
			shuffle($question['TargetChoice']);
		}
	}

}
?>
