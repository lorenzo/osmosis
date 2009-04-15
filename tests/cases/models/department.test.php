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

loadModel('Department');

class DepartmentTestCase extends CakeTestCase {
	var $TestObject = null;

	function setUp() {
		$this->TestObject = new Department();
		$this->TestObject->useDbConfig = 'test_suite';
		$this->TestObject->tablePrefix = 'test_suite_';
	}

	function tearDown() {
		unset($this->TestObject);
	}
	
	/*
	 * Test field validation
	 */
	function testValidation() {
		$data = array('Department'=>array('name'=>'','description'=>'Esta es una descripcion'));
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$this->assertFalse($valid);
		$this->assertEqual($this->TestObject->validationErrors,array('name'=>'Error.empty'));
		
		$this->TestObject->create();
		$data = array('Department'=>array('name'=>'esto es un nombre','description'=>''));
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$this->assertFalse($valid);
		
		$this->assertEqual($this->TestObject->validationErrors,array('description'=>'Error.empty'));
	}
}
?>
