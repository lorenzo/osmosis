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

App::import('Model','scorm.Rule');

class TestRule extends Rule {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class RuleTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('plugin.scorm.rule','plugin.scorm.condition');
	
	function start() {
		parent::start();
		$this->TestObject = new TestRule();
		$this->TestObject->Rollup->useDbConfig = 'test_suite';
		$this->TestObject->Condition->useDbConfig = 'test_suite';
	}
	
	function testInstance() {
		$this->assertTrue(is_a($this->TestObject,'Rule'));
	}

	function testValidation1() {
		$data = array();
		$this->TestObject->set($data);
		$valid = $this->TestObject->validates();
		$expectedErrors = array (
			'type' => 'scorm.rule.type.allowedvalues',
			'action' => 'scorm.rule.action.allowedvalues'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}

	function testValidation2() {
		$data = array(
			'Rule' => array(
				'conditionCombination' => 'all',
			)
		);
		$this->TestObject->set($data);
		$valid = $this->TestObject->validates();
		$expectedErrors = array (
			'type' => 'scorm.rule.type.allowedvalues',
			'action' => 'scorm.rule.action.allowedvalues'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}

	function testValidation3() {
		$allowedActions = array (
			'pre' => array('skip','disabled','hiddenFromChoice','stopForwardTraversal'),
			'post' => array('exitParent','exitAll','retry','retryAll','continue','previous'),
			'exit' => array('exit'),
			'rollup' => array('satisfied','notSatisfied','completed','incomplete')
		);
		foreach($allowedActions as $type => $actions) {
			foreach($actions as $action) {
				$data = array(
					'Rule' => array(
						'type' => $type,
						'conditionCombination' => 'any',
						'action' => $action
					)
				);
				$this->TestObject->create();
				$this->TestObject->set($data);
				$valid = $this->TestObject->validates();
				$expectedErrors = array();
				$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
			}
		}
	}

	function testValidation4() {
		$data = array(
			'Rule' => array (
				'type' => 'pre',
				'action' => 'skip',
				'minimumPercent' => '1',
				'minimumCount' => 'four'
			)
		);
		$this->TestObject->set($data);
		$valid = $this->TestObject->validates();
		$expectedErrors = array (
			'minimumPercent' => 'scorm.rule.minimumpercent.decimal',
			'minimumCount' => 'scorm.rule.minimumcount.number'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testValidation5() {
		$data = array(
			'Rule' => array (
				'type' => 'pre',
				'action' => 'skip',
				'minimumPercent' => '-0.01',
				'minimumCount' => '-0.0000001'
			)
		);
		$this->TestObject->set($data);
		$valid = $this->TestObject->validates();
		$expectedErrors = array (
			'minimumPercent' => 'scorm.rule.minimumpercent.range',
			'minimumCount' => 'scorm.rule.minimumcount.nonegative'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testValidation6() {
		$data = array(
			'Rule' => array (
				'type' => 'pre',
				'action' => 'skip',
				'minimumPercent' => '1.1',
				'minimumCount' => '1'
			)
		);
		$this->TestObject->set($data);
		$valid = $this->TestObject->validates();
		$expectedErrors = array (
			'minimumPercent' => 'scorm.rule.minimumpercent.range'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}

	function testValidation7() {
		$data = array(
			'Rule' => array (
				'type' => 'pre',
				'action' => 'skip',
				'minimumPercent' => '0.11109',
			)
		);
		$this->TestObject->set($data);
		$valid = $this->TestObject->validates();
		$expectedErrors = array ();
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testValidation8() {
		$data = array(
				'type' => 'exit',
				'action' => 'exit',
		);
		$this->TestObject->set($data);
		$valid = $this->TestObject->validates();
		$expectedErrors = array ();
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testCRUD() {
		// Insert a new Condition
		$data = array (
			'type'				=> 'pre',
			'conditionCombination'	=> 'any',
			'action'				=> 'hiddenFromChoice',
			'minimumPercent'		=> '0.0000',
			'minimumCount'			=> '1'
		);
		
		$this->TestObject->save($data);
		$this->assertEqual(2, $this->TestObject->findCount());
		
		// Update the inserted Condition and Read
		$data = array (
			'type'				=> 'post',
			'conditionCombination'	=> 'any',
			'action'				=> 'exitAll',
			'minimumPercent'		=> '1.0000',
			'minimumCount'			=> '1'
		);
		$this->TestObject->save($data);
		$this->assertEqual(2, $this->TestObject->findCount());
		$last_id = $this->TestObject->getLastInsertID();
		$this->TestObject->id = $last_id;
		$expectedData = array(
			'Rule' => Set::merge(
				$data,
				array('id' => $last_id, 'rollup_id' => '','sco_id'=>'') 
			),
			'Condition' => array()
		);
		$this->assertEqual($expectedData, $this->TestObject->read());
		
		// Delete
		$this->TestObject->delete();
		$this->assertEqual(1, $this->TestObject->findCount());
	}
	
	function testSave() {
		$data = array ('Rule' => array(
			'type'		=> 'exit',
			'Action'	=> array('action'=>'exit'),
			'Condition'	=> array(array('condition'=>'completed')),
			'sco_id'	=> 255
			)
		);
		$expected = array(
			'Rule' => array(
				'id'		=> 2,
				'type'		=> 'exit',
				'action'	=> 'exit',
				'sco_id'	=> 255,
				'conditionCombination' => 'all',
				'minimumCount' => 0,
				'minimumPercent' => 0.0000,
				'rollup_id' => ''
				),
			'Condition' => array( 
				array(
					'id' => 2,
					'referencedObjective' => '',
	                'measureThreshold' => '',
	                'operator' => 'noOp',
	                'ruleCondition'	=> 'completed',
	                'rule_id' => 2
					)
				)
			);
		$this->TestObject->create();
		$this->TestObject->save($data);
		$result = $this->TestObject->findById($this->TestObject->getLastInsertID());
		$this->assertEqual($result,$expected);
	}
}
?>
