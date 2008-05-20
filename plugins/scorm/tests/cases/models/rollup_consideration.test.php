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
App::import('Model', 'scorm.RollupConsideration');

class TestRollupConsideration extends RollupConsideration {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class RollupConsiderationTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('plugin.scorm.rollup_consideration');

	function start() {
		parent::start();
		$this->TestObject = new TestRollupConsideration();
	}
	
	function testInstance() {
		$this->assertTrue(is_a($this->TestObject,'RollupConsideration'));
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
			'RollupConsideration' => array(
				'requiredForSatisfied'			=> 'yes',
				'requiredForNotSatisfied'		=> 'nope',
				'requiredForComplete'			=> 'yes',
				'requiredForIncomplete'			=> 'nope',
				'measureSatisfactionIfActive'	=> 'yes',
			)
		);
		$this->TestObject->set($data);
		$valid = $this->TestObject->validates();
		$expectedErrors = array(
			'requiredForSatisfied'			=> 'scormplugin.rollupconsideration.requiredforsatisfied.token',
			'requiredForNotSatisfied'		=> 'scormplugin.rollupconsideration.requiredfornotsatisfied.token',
			'requiredForComplete'			=> 'scormplugin.rollupconsideration.requiredforcomplete.token',
			'requiredForIncomplete'			=> 'scormplugin.rollupconsideration.requiredforincomplete.token',
			'measureSatisfactionIfActive'	=> 'scormplugin.rollupconsideration.measuresatisfactionifactive.boolean',
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testValidation3() {
		$token = array ('always', 'ifAttempted', 'ifNotSkipped', 'ifNotSuspended');
		foreach ($token as &$value){
		$this->TestObject->create();
		$data = array(
			'RollupConsideration' => array(
				'requiredForSatisfied'			=> $value,
				'requiredForNotSatisfied'		=> $value,
				'requiredForComplete'			=> $value,
				'requiredForIncomplete'			=> $value,
				'measureSatisfactionIfActive'	=> 'true',
			)
		);
			$this->TestObject->set($data);
			$valid = $this->TestObject->validates();
			$expectedErrors = array();
			$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
		}		
	}
	
	function testValidation4() {
			$token = array ('always', 'ifAttempted', 'ifNotSkipped', 'ifNotSuspended');
			foreach ($token as &$value){
			$this->TestObject->create();
			$data = array(
				'RollupConsideration' => array(
					'requiredForSatisfied'			=> $value,
					'requiredForNotSatisfied'		=> $value,
					'requiredForComplete'			=> $value,
					'requiredForIncomplete'			=> $value,
					'measureSatisfactionIfActive'	=> 'false',
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
    		'RollupConsideration' => array(
					'requiredForSatisfied'			=> 'always',
					'requiredForNotSatisfied'		=> 'always',
					'requiredForComplete'			=> 'always',
					'requiredForIncomplete'			=> 'always',
					'measureSatisfactionIfActive'	=> 'true',
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
