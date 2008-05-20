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

App::import('Model', 'scorm.Condition');

class TestCondition extends Condition {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class ConditionTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('plugin.scorm.condition');

	function start() {
		parent::start();
		$this->TestObject = new TestCondition();
		$this->TestObject->Rule->useDbConfig = 'test';
	}
	
	function testInstance() {
		$this->assertTrue(is_a($this->TestObject,'Condition'));
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
			'measureThreshold' => '-1.01',
			'operator' => 'bubby',
			'ruleCondition' => 'greatWork'
		);
		$this->TestObject->set($data);
		$valid = $this->TestObject->validates();
		$expectedErrors = array(
			'measureThreshold' => 'scorm.condition.measurethreshold.range',
			'operator' => 'scorm.condition.operator.token',
			'ruleCondition' => 'scorm.condition.condition.token'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testValidation3() {
		$data = array(
			'measureThreshold' => '1.01',
			'operator' => 'noOp'
		);
		$this->TestObject->set($data);
		$valid = $this->TestObject->validates();
		$expectedErrors = array(
			'ruleCondition'	=> 'scorm.condition.condition.token',
			'measureThreshold' => 'scorm.condition.measurethreshold.range',
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testValidation4() {
		$allowedConditions = array(
			'satisfied',
			'objectiveStatusKnown',
			'objectiveMeasureKnown',
			'objectiveMeasureGreaterThan',
			'objectiveMeasureLessThan',
			'completed',
			'activityProgressKnown',
			'attempted',
			'attemptLimitExceeded',
			'timeLimitExceeded',
			'outsideAvailableTimeRange',
			'always'
		);
		foreach($allowedConditions as $allowedCondition) {
			$data = array(
				'measureThreshold' => '0.0010',
				'operator' => 'not',
				'ruleCondition' => $allowedCondition
			);
			$this->TestObject->create();
			$this->TestObject->set($data);
			$valid = $this->TestObject->validates();
			$expectedErrors = array();
			$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
		}
	}
	
	function testCRUD() {
		// Insert a new Condition
		$data = array (
			'referencedObjective' => 'HOLA1',
			'measureThreshold' => '0.0100',
			'operator' => 'not',
			'ruleCondition' => 'activityProgressKnown'
		);
		$this->TestObject->save($data);
		$this->assertEqual(2, $this->TestObject->findCount());
		
		// Update the inserted Condition and Read
		$data = array (
			'referencedObjective' => 'HOLA_UPDATE',
			'measureThreshold' => '0.0100',
			'operator' => 'noOp',
			'ruleCondition' => 'activityProgressKnown'
		);
		$this->TestObject->save($data);
		$this->assertEqual(2, $this->TestObject->findCount());
		$last_id = $this->TestObject->getLastInsertID();
		$this->TestObject->id = $last_id;
		$expectedData = array(
			'Condition' => Set::merge(
				$data,
				array('id' => $last_id, 'rule_id' => '') 
			),
			'Rule' => array()
		);
		$this->assertEqual($expectedData, $this->TestObject->read());
		
		// Delete
		$this->TestObject->delete();
		$this->assertEqual(1, $this->TestObject->findCount());
	}
}
?>
