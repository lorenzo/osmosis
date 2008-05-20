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

App::import('Model', 'Course');

class CourseTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('course');
	function setUp() {
		$this->TestObject = new Course();
		$this->TestObject->useDbConfig = 'test_suite';
		$this->TestObject->tablePrefix = 'test_suite_';
	}

	function tearDown() {
		unset($this->TestObject);
	}

	function testValidation1() {
		$data = array();
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array(
			'department_id'		=> 'Error.empty',
			'owner_id'			=> 'Error.empty',
			'code' 				=> 'Error.empty',
			'name'				=> 'Error.empty',
			'description'		=> 'Error.empty'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testValidation2() {
		$this->TestObject->create();
		$this->TestObject->data = array(
			'Course' => array(
				'department_id' 	=> 'a',
				'owner_id' 			=> '1çb',
				'code' 				=> '1234567890a',
				'name' 				=> 'cosa ñángara',
				'description' 		=> 'xdf'
			)
		);
		$valid = $this->TestObject->validates();
		$expectedErrors = array(
			'code'				=> 'Error.maxlength'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testValidation3() {
		$this->TestObject->create();
		$this->TestObject->data = array(
			'Course' => array(
				'department_id' 	=> '1',
				'owner_id' 			=> '1413',
				'code' 				=> '1abc',
				'name' 				=> '<span>dasdas</span>',
				'description' 		=> 'xdf'
			)
		);
		$valid = $this->TestObject->validates();
		$expectedErrors = array();
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testValidation4() {
		$this->TestObject->id = 2;
		$this->TestObject->data = array(
			'Course' => array(
				'department_id'		=> 1,
				'owner_id'			=> 1,
				'code' 				=> '1abc',
				'name' 				=> '<span>dasdas</span>',
				'description' 		=> 'xdf'
			)
		);
		$valid = $this->TestObject->validates();
		$expectedErrors = array();
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
}
?>
