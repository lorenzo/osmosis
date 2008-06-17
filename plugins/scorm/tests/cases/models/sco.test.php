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

App::import('Model', 'scorm.Sco');

class TestSco extends Sco {
	var $cacheSources = false;
	var $useDbConfig  = 'test';
}

class ScoTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array(
                    	'plugin.scorm.sco',
                    	'plugin.scorm.objective',
                    	'plugin.scorm.randomization',
                    	'plugin.scorm.rollup',
                    	'plugin.scorm.rule',
                    	'plugin.scorm.choice_consideration',
                    	'plugin.scorm.rollup_consideration',
                    	'plugin.scorm.sco_presentation',
                    	'plugin.scorm.control_mode',
                    	'plugin.scorm.delivery_control',
                    	'plugin.scorm.condition');

	function start() {
		parent::start();
		$this->TestObject = new TestSco();
		$this->TestObject->SubItem->useDbConfig = 'test';
		$this->TestObject->Objective->useDbConfig = 'test';
		$this->TestObject->PrimaryObjective->useDbConfig = 'test';
		$this->TestObject->Randomization->useDbConfig = 'test';
		$this->TestObject->Rollup->useDbConfig = 'test';
		$this->TestObject->Rule->useDbConfig = 'test';
		$this->TestObject->Rule->Condition->useDbConfig = 'test';
		$this->TestObject->Choice->useDbConfig = 'test';
		$this->TestObject->Consideration->useDbConfig = 'test';
		$this->TestObject->Presentation->useDbConfig = 'test';
		$this->TestObject->ControlMode->useDbConfig = 'test';
		$this->TestObject->DeliveryControl->useDbConfig = 'test';
		
	}
	
	function testInstance() { die();
		$this->assertTrue(is_a($this->TestObject,'Sco'));
	}
	
	function testValidation1() {
		$data = array();
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array(
		'manifest'			=> 'scormplugin.sco.manifest.empty',
		'organization'		=> 'scormplugin.sco.organization.empty',
		'identifier'		=> 'scormplugin.sco.identifier.empty',
		'title'				=> 'scormplugin.sco.title.empty'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testValidation2() {
		$data = array(
		'manifest'			=> 'ASDGSDS-SDFSADAS',
		'organization'		=> 'DMCQ',
		'identifier'		=> 'CDADASA-GSDGDEG-HRETSAS-SDSDSD',
		'href'				=> 'index.html',
		'title'				=> 'First sco',
		'completionThreshold' => 'a lot',
		'parameters'		=> '',
		'isvisible'			=> 'yes',
		'attemptAbsoluteDurationLimit' => '',
		'dataFromLMS'		=> '',
		'attemptLimit'		=> 'few attempts',
		'scormType'			=> 'nifty type'
		);
		$this->TestObject->set($data);
		$valid = $this->TestObject->validates();
		$expectedErrors = array(
		'completionThreshold'			=> 'scormplugin.sco.completionthreshold.decimal',
		'parameters'					=> 'scormplugin.sco.parameters.empty',
		'isvisible'						=> 'scormplugin.sco.isvisible.boolean',
		'attemptAbsoluteDurationLimit'	=> 'scormplugin.sco.attemptabsolutedurationlimit.empty',
		'attemptLimit'					=> 'scormplugin.sco.attemptlimit.integer',
		'scormType'						=> 'scormplugin.sco.scormtype.token',
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testValidation3() {
		$data = array(
		'manifest'			=> 'ASDGSDS-SDFSADAS',
		'organization'		=> 'DMCQ',
		'identifier'		=> 'CDADASA-GSDGDEG-HRETSAS-SDSDSD',
		'href'				=> 'index.html',
		'title'				=> 'First sco',
		'completionThreshold' => '1.5',
		'parameters'		=> 'pa=13&f=5',
		'isvisible'			=> 'true',
		'attemptAbsoluteDurationLimit' => '123',
		'dataFromLMS'		=> 'fdfhrertertert',
		'attemptLimit'		=> '12545',
		'scormType'			=> 'sco'
		);
		$this->TestObject->set($data);
		$valid = $this->TestObject->validates();
		$expectedErrors = array();
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testSaveWithSubitems() {
		$data = array();
		$data['Sco'] = array(
		'id'				=> 2,
		'manifest'			=> 'ASDGSDS-SDFSADAS',
		'organization'		=> 'DMCQ',
		'scorm_id'            => 99,
		'identifier'		=> 'CDADASA-GSDGDEG-HRETSAS-SDSDSD',
		'title'				=> 'First sco',
		'completionThreshold' => '1.5',
		'isvisible'			=> 'true',
		'attemptAbsoluteDurationLimit' => '123',
		'dataFromLMS'		=> 'fdfhrertertert',
		'attemptLimit'		=> '12545',
		'scormType'			=> 'asset'
		);
		$data['SubItem'][] = array(
				'identifier'	=> 'CDADASA-GSDGDEG-WEER-SDSDSD',
				'href'		=> 'index.html',
				'title'		=> 'Second sco',
				'parameters'	=> 'pa=13&f=5',
				'scormType'		=> 'sco',
		);
		$data['Objective'][] = array(
			'objectiveID'			=> 'FAADAS-GDFGDFGF',
			'satisfiedByMeasure'	=> 'true',
			'minNormalizedMeasure'	=> '0.6'
		);
		$data['Objective'][] = array(
			'objectiveID'			=> 'FAADAS-DDWWAAFF',
			'satisfiedByMeasure'	=> 'true',
			'minNormalizedMeasure'	=> '0.9'
		);
		$data['PrimaryObjective']= array(
		'objectiveID'			=> 'FOFIFA-DDWWAAFF',
		'satisfiedByMeasure'	=> 'false'
		);
		$data['Randomization'] = array(
		'randomizationTiming'	=> 'once',
		'selectCount'			=> '15',
		'reorderChildren'		=> 'true',
		'selectionTiming'		=> 'onEachNewAttempt'
		);
		$data['Rollup'] = array(
			'rollupObjectiveSatisfied'	=> 'true',
			'rollupProgressCompletion'	=> 'false',
			'objectiveMeasureWeight'	=> '0.5000'
		);
		$data['Rollup']['Rule'][] = array(
			'Condition' =>array( array('condition'=>'completed')),
			'Action' => array('action'=>'satisfied')
		);
		$data['Rule']['Pre'] = array( 
			array(
			'conditionCombination'	=> 'any',
			'action'				=> 'disabled',
			'minimumPercent'		=> '0.0000',
			'minimumCount'			=> '1'
			)
		);
		$data['Rule']['Post'] = array(
			array(
			'conditionCombination'	=> 'any',
			'action'				=> 'retry',
			'minimumPercent'		=> '0.0000',
			'minimumCount'			=> '1'
			)
		);
		$data['Choice'] = array(
			'preventActivation'	=> 'true',
			'constrainChoice'		=> 'false'
		);
		$data['Consideration'] = array(
			'requiredForSatisfied'		=> 'always',
			'requiredForNotSatisfied'	=> 'ifAttempted',
			'requiredForComplete'		=> 'ifNotSkipped',
			'requiredForIncomplete'		=> 'ifNotSuspended',
			'measureSatisfactionIfActive'=> 'true',
		);
		$data['Presentation'][] = array(
			'hideKey'	=> 'previous'
		);
		$data['Presentation'][] = array(
			'hideKey'	=> 'continue'
		);
		$data['Control'] = array(
			'choiceExit'					=> 'false',
			'choice'						=> 'true',
			'flow'						=> 'false',
			'forwardOnly'					=> 'false',
			'useCurrentAttemptObjectiveInfo'		=> 'true',
			'useCurrentAttemptProgressInfo'		=> 'true'
		);
		$data['DeliveryControl'] = array(
			'tracked'				=> 'true',
			'completionSetByContent'	=> 'false',
			'objectiveSetByContent'		=> 'true'
		);
		$this->TestObject->save($data);
		$this->assertEqual(2,$this->TestObject->findCount(array('scorm_id'=>99)));
		$results = $this->TestObject->findById(2);
		$this->assertEqual(1,count($results['SubItem']));
		$this->assertEqual(2,count($results['Objective']));
		$this->assertFalse(empty($results['PrimaryObjective']));
		$this->assertFalse(empty($results['Randomization']));
		$this->assertEqual(2,count($results['Rule']));
		$data['Choice']['sco_id'] = 2;
		unset($results['Choice']['id']);
		$this->assertEqual($data['Choice'],$results['Choice']);
		$data['Consideration']['sco_id'] = 2;
		unset($results['Consideration']['id']);
		$this->assertEqual($data['Consideration'],$results['Consideration']);
		$this->assertEqual(2,count($results['Presentation']));
		$data['Control']['sco_id'] = 2;
		unset($results['Control']['id']);
		$this->assertEqual($data['Control'],$results['Control']);
		$data['DeliveryControl']['sco_id'] = 2;
		unset($results['DeliveryControl']['id']);
	$this->assertEqual($data['DeliveryControl'],$results['DeliveryControl']);
	}
}
?>
