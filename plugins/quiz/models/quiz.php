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
class Quiz extends QuizAppModel {

	var $name = 'Quiz';
	var $validate = array(
		'name' => array(
		    'required' => array(
		        'rule' => array('notEmpty'),
		        'required' => true,
		        'allowEmpty' => false,
				),
		),
	);

	var $useTable = 'quiz_quizzes';
	var $hasAndBelongsToMany = array(
			'Question' => array(
				'className'	=> 'Quiz.Question',
				'joinTable' => 'quiz_questions_quizzes',
				'foreignKey' => 'quiz_id',
				'associationForeignKey' => 'question_id',
				'with' => 'Quiz.QuizQuestion',
				'unique' => true,
				'order' => array('QuizQuestion.position' => 'ASC')
			)
	);
	
	
	function __construct($id = false, $table = null, $ds = null) {
		$this->setErrorMessage(
			'name.required', __('The name can not be empty',true)
		);
		parent::__construct($id,$table,$ds);
	}

	function addQuestions($question_list = array()) {
		foreach($question_list as $type => $questions) {
			if (!isset($this->Question->questionTypes)) {
				continue;
			}
			
			foreach ($questions as $question_id) {
				if ($question_id ==0) continue;
				$save = array(
					'question_id' => $question_id,
					'quiz_id' => $this->id
				);
				$this->QuizQuestion->create();
				if (!$this->QuizQuestion->save($save)) {
					return false;
				}
			}
		}
		return true;
	}

	function removeQuestion($quizQuestion) {
		return $this->QuizQuestion->del($quizQuestion);
	}

	function moveQuestion($quizQuestion,$direction,$position = null) {
		if ($direction == 'to') {
			if (is_numeric($position) && $position > 0)
				return $this->QuizQuestion->setPosition($quizQuestion,$position);
			else
				return false;
		}
		return $this->QuizQuestion->{'move'.Inflector::camelize($direction)}($quizQuestion);
	}
	
	function saveAnswers($id,$answers,$member_id) {
		return $this->Question->saveAnswers($answers,$member_id);
	}
}
?>
