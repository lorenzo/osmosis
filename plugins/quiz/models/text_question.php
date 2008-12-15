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
class TextQuestion extends QuizAppModel {

	var $name = 'TextQuestion';
	var $validate = array(
		'title' => array(
			'required' => array(
				'rule' => array('custom', '/.+/'),
				'allowEmpty' => false
		)
	),
		'body' => array(
				'required' => array(
					'rule' => array('custom', '/.+/'),
					'allowEmpty' => false
			)
		),
		'format' => VALID_NOT_EMPTY,
	);

	var $useTable = 'quiz_text_questions';
	var $hasAndBelongsToMany = array(
			'Quiz' => array(
				'className' => 'quiz.Quiz',
				'joinTable' => 'quiz_text_questions_quizzes',
				'foreignKey' => 'text_question_id',
				'associationForeignKey' => 'quiz_id',
				'with' => 'Quiz.QuizText'
			),
	);
	
	/**
	 * Model contructor. Initializes the validation error messages with i18n
	 *
	 * @see Model::__construct
	 */
	function __construct($id = false, $table = null, $ds = null) {
		$this->setErrorMessage(
			'title.required', __('The title can not be empty',true)
		);
		$this->setErrorMessage(
			'body.required', __('The content of the question can not be empty',true)
		);
		parent::__construct($id,$table,$ds);
	}
}
?>
