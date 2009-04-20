<?php
/* SVN FILE: $Id: text_question.php 599 2008-12-15 20:16:48Z jose.zap $ */
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
 * @version			$Revision: 599 $
 * @modifiedby		$LastChangedBy: jose.zap $
 * @lastmodified	$Date: 2008-12-15 15:46:48 -0430 (Mon, 15 Dec 2008) $
 * @license			http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License Version 3
 */
class Question extends QuizAppModel {

	var $name = 'Question';
	var $useTable = 'quiz_questions';
	var $hasAndBelongsToMany = array(
			'Quiz' => array(
				'className' => 'quiz.Quiz',
				'joinTable' => 'quiz_quizzes',
				'foreignKey' => 'question_id',
				'associationForeignKey' => 'quiz_id',
				'with' => 'Quiz.QuizQuestion'
			),
	);
	
	var $actsAs = array(
		'Quiz.Inheritable' => array(
			'method' => 'CTIPARENT',
			'pluginScope' => 'Quiz'
		),
		'Taggable' => array(
			'joinTable' => 'quiz_questions_tags',
			'foreignKey' => 'question_id'
		),
		'Searchable',
	);
	var $validate = array(
		'body' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'allowEmpty' => false
			)
		)
	);
	
	var $questionTypes = array('TextQuestion','OrderingQuestion','MatchingQuestion','ChoiceQuestion');

	/**
	 * Model contructor. Initializes the validation error messages with i18n
	 *
	 * @see Model::__construct
	 */
	function __construct($id = false, $table = null, $ds = null) {
		$this->setErrorMessage(
			'body.required', __('The content of the question can not be empty',true)
		);
		parent::__construct($id,$table,$ds);
	}
	
	function beforeFind($query){
			if (!empty($query['type']) && in_array($query['type'],$this->questionTypes) &&
				$this->recursive >= 1 || (!empty($query['recursive']) && $query['recursive'] >= 1)) {

					if (empty($query['contain']) || !in_array('Quiz',$query['contain']) || isset($query['contain']['Quiz']))
						$this->unbindModel(array('hasAndBelongsToMany' => array('Quiz')));
			}
			return $query;
	}
	function find($method,$query) {
		if (in_array($method,$this->questionTypes))
			return ClassRegistry::init('Quiz.'.$method)->find('all',$query);

		if ($method == 'count' && !empty($query['type']) && empty($query['fromParent']) && in_array($query['type'],$this->questionTypes)) {
			$query['fromParent'] = true;
			return ClassRegistry::init('Quiz.'.$query['type'])->find('count',$query);
		}
		return parent::find($method,$query);
	}
	
	function afterFind($results,$primary = false) {
		if (!$primary && !isset($results[0][$this->alias][0]))
			return $results;
			
		if ($primary && empty($results[0][$this->alias]))
			return $results;

		$results = $this->insertChildData($results);
		return $results;
	}
	
	function saveAnswers($answers,$member) {
		$result = true;
		foreach ($answers as $questionType => $answer) {
			if (!isset($this->{$questionType}))
				$this->{$questionType} = ClassRegistry::init('Quiz.'.$questionType);
			$result = $result && $this->{$questionType}->saveAnswers($answer,$member);
			if (!$result)
				break;
		}
		return $result;
	}
	
}
?>
