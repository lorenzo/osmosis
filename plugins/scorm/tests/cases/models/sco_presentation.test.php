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
App::import('Model', 'scorm.ScoPresentation');

class TestScoPresentation extends ScoPresentation {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}


class ScoPresentationTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('plugin.scorm.sco_presentation');

	function start() {
		parent::start();
		$this->TestObject = new TestScoPresentation();
	}
	
	function testInstance() {
		$this->assertTrue(is_a($this->TestObject,'ScoPresentation'));
	}

	function testValidation1() {
		$data = array();
		$this->TestObject->set($data);
		$valid = $this->TestObject->validates();
		$expectedErrors = array();
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testValidation2() {
		$data = array(
			'ScoPresentation' => array(
				'hideKey'	=> 'yes',
			)
		);
		$this->TestObject->set($data);
		$valid = $this->TestObject->validates();
		$expectedErrors = array(
			'hideKey'			=> 'scormplugin.scopresentation.hidekey.token',
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testValidation3() {
		$token = array ('previous', 'continue', 'exit', 'exitAll','abandon','abandonAll','suspendAll');
		foreach ($token as &$value){
		$this->TestObject->create();
		$data = array(
			'ScoPresentation' => array(
				'hideKey' => $value,
			)
		);
			$this->TestObject->set($data);
			$valid = $this->TestObject->validates();
			$expectedErrors = array();
			$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
		}		
	}
	function testSave() {
		$data = array(
    		'ScoPresentation' => array(
					'hideKey'=> 'continue',
					)
				);
		$this->TestObject->save($data);
		$this->assertEqual(2,$this->TestObject->findCount());
	}
	
	function testSave2() {
		$data = array();
		$this->TestObject->save($data);
		$this->assertEqual(1,$this->TestObject->findCount());
	}
	
}
?>
