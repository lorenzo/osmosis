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

App::import('Model', 'scorm.MapInfo');

class TestMapInfo extends MapInfo {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class MapInfoTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('plugin.scorm.map_info');

	function start() {
		parent::start();
		$this->TestObject = new TestMapInfo();
	}
	
	function testInstance() {
		$this->assertTrue(is_a($this->TestObject,'MapInfo'));
	}

	function testValidation1() {
		$data = array();
		$this->TestObject->set($data);
		$valid = $this->TestObject->validates();
		$expectedErrors = array(
    		'targetObjectiveID'		=> 'scormplugin.mapinfo.targetobjectiveid.empty'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testValidation2() {
		$data = array(
    		'targetObjectiveID'		=> 'SADASdsafFA-FSDADSASD',
    		'readSatisfiedStatus'	=> 'false',
    		'readNormalizedMeasure'	=> 'true',
    		'writeSatisfiedStatus'	=> 'true',
    		'writeNormalizedMeasure'=> 'false'
		);
		$this->TestObject->set($data);
		$valid = $this->TestObject->validates();
		$expectedErrors = array();
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testValidation3() {
		$data = array(
    		'targetObjectiveID'		=> '',
    		'readSatisfiedStatus'	=> 'yes',
    		'readNormalizedMeasure'	=> 'no',
    		'writeSatisfiedStatus'	=> 'ok',
    		'writeNormalizedMeasure'=> 'maybe'
		);
		$this->TestObject->set($data);
		$valid = $this->TestObject->validates();
		$expectedErrors = array(
    		'targetObjectiveID'		=> 'scormplugin.mapinfo.targetobjectiveid.empty',
    		'readSatisfiedStatus'	=> 'scormplugin.mapinfo.readsatisfiedstatus.boolean',
    		'readNormalizedMeasure'	=> 'scormplugin.mapinfo.readnormalizedmeasure.boolean',
    		'writeSatisfiedStatus'	=> 'scormplugin.mapinfo.writesatisfiedstatus.boolean',
    		'writeNormalizedMeasure'=> 'scormplugin.mapinfo.writenormalizedmeasure.boolean'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testSave() {
		$data['MapInfo'] = array(
		'objective_id'			=> 1,
    		'targetObjectiveID'		=> 'SADASdsafFA-FSDADSASD',
    		'readSatisfiedStatus'	=> 'false',
    		'readNormalizedMeasure'	=> 'true',
    		'writeSatisfiedStatus'	=> 'true',
    		'writeNormalizedMeasure'=> 'false'
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
