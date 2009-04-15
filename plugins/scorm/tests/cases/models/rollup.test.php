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

App::import('Model', 'scorm.Rollup');

class TestRollup extends Rollup {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class RollupTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('plugin.scorm.rollup','plugin.scorm.rule','plugin.scorm.condition');

	function start() {
		parent::start();
		$this->TestObject = new TestRollup();
		$this->TestObject->Rule->useDbConfig = 'test_suite';
		$this->TestObject->Rule->Condition->useDbConfig = 'test_suite';
	
	}
	
	function testInstance() {
		$this->assertTrue(is_a($this->TestObject,'Rollup'));
	}

	function testValidation1() {
		$data = array();
		$this->TestObject->set($data);
		$valid = $this->TestObject->validates();
		$expectedErrors = array ();
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}

	function testValidation2() {
		$data = array(
			'rollupObjectiveSatisfied' => 'yes',
			'rollupProgressCompletion' => 'niet',
			'objectiveMeasureWeight' => '1'
		);
		$this->TestObject->set($data);
		$valid = $this->TestObject->validates();
		$expectedErrors = array (
			'rollupObjectiveSatisfied' => 'scorm.rollup.rollupobjectivesatisfied.boolean',
			'rollupProgressCompletion' => 'scorm.rollup.rollupprogresscompletion.boolean',
			'objectiveMeasureWeight' => 'scorm.rule.minimumpercent.decimal'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}

	function testValidation3() {
		$data = array(
			'rollupObjectiveSatisfied' => 'true',
			'rollupProgressCompletion' => 'true',
			'objectiveMeasureWeight' => '-0.00001'
		);
		$this->TestObject->set($data);
		$valid = $this->TestObject->validates();
		$expectedErrors = array (
			'objectiveMeasureWeight' => 'scorm.rule.minimumpercent.range'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}

	function testValidation4() {
		$data = array(
			'rollupObjectiveSatisfied' => 'false',
			'rollupProgressCompletion' => 'false',
			'objectiveMeasureWeight' => '1.00001'
		);
		$this->TestObject->set($data);
		$valid = $this->TestObject->validates();
		$expectedErrors = array (
			'objectiveMeasureWeight' => 'scorm.rule.minimumpercent.range'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}

	function testValidation5() {
		$data = array(
			'objectiveMeasureWeight' => '0.00001'
		);
		$this->TestObject->set($data);
		$valid = $this->TestObject->validates();
		$expectedErrors = array ();
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testCRUD() {
		// Insert a new Condition
		$data = array (
			'rollupObjectiveSatisfied' => 'false',
			'rollupProgressCompletion' => 'false',
			'objectiveMeasureWeight' => '0.9931'
		);
		$this->TestObject->save($data);
		$this->assertEqual(2, $this->TestObject->findCount());
		
		// Update the inserted Condition and Read
		$data = array (
			'rollupObjectiveSatisfied' => 'true',
			'rollupProgressCompletion' => 'true',
			'objectiveMeasureWeight' => '1.0000',
			'sco_id' => 1
		);
		$this->TestObject->save($data);
		$this->assertEqual(2, $this->TestObject->findCount());
		$last_id = $this->TestObject->getLastInsertID();
		$this->TestObject->id = $last_id;
		$expectedData = array(
			'Rollup' => Set::merge(
				$data,
				array('id' => $last_id) 
			),
			'Rule' => array()
		);
		$this->assertEqual($expectedData, $this->TestObject->read());

		// Delete
		$this->TestObject->delete();
		$this->assertEqual(1, $this->TestObject->findCount());
	}
	
	function testSave() {
		$data = array (
			'rollupObjectiveSatisfied' => 'false',
			'rollupProgressCompletion' => 'false',
			'objectiveMeasureWeight' => '0.9931'
		);
		$data['Rule'][] = array(
			'Condition' =>array( array('condition'=>'completed')),
			'Action' => array('action'=>'satisfied')
		);
		$this->TestObject->save($data);
		$this->assertEqual(2,$this->TestObject->findCount());
		$this->assertEqual(1,$this->TestObject->Rule->findCount(array('rollup_id'=>$this->TestObject->getLastInsertID())));
		$this->assertEqual(1,$this->TestObject->Rule->Condition->findCount(array('rule_id'=>$this->TestObject->Rule->getLastInsertID())));
	}

}
?>
