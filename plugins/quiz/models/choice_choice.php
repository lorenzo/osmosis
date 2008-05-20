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
class ChoiceChoice extends QuizAppModel {

	var $name = 'ChoiceChoice';
	var $validate = array(
		// 'choice_question_id' => VALID_NOT_EMPTY,
		'text' => array(
			'required' => array(
				'rule' => array('custom', '/.+/')
			)
		),
		'position' => array(
			'positionLessThanTotal' => array(
				'rule' => array('positionLessThanTotal'),
				'allowEmpty' => true
			)// ,
			// 			'positionLessThanMin' => array(
			// 				'rule' => array('positionLessThanMin'),
			// 				'allowEmpty' => true
			// 			),
		)
	);

	var $useTable = 'quiz_choice_choices';

	function __construct($id = false, $table = null, $ds = null) {
		$this->setErrorMessage(
			'text.required',
			__('Please write the text for this choice',true)
		);
		$this->setErrorMessage(
			'position.positionLessThanTotal',
			__('This position is higher the total number of choices available', true)
		);
		parent::__construct($id, $table, $ds);
	}
	
	function positionLessThanTotal() {
		return (intval($this->data['ChoiceChoice']['position']) <= intval($this->data['ChoiceChoice']['total']));
	}
	
}
?>
