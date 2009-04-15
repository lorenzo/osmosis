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
App::import('Model', 'scorm.Scorm');

class TestScorm extends Scorm {
	var $cacheSources = false;
	var $useDbConfig  = 'test';
}

class ScormTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('plugin.scorm.scorm',
                        	'plugin.scorm.sco',
                        	'plugin.scorm.objective',
                        	'plugin.scorm.randomization',
                        	'plugin.scorm.rollup',
                        	'plugin.scorm.rule',
							'plugin.scorm.condition',
                        	'plugin.scorm.choice_consideration',
                        	'plugin.scorm.rollup_consideration',
                        	'plugin.scorm.sco_presentation',
                        	'plugin.scorm.control_mode',
                        	'plugin.scorm.delivery_control');
	function start() {
		parent::start();
		$this->TestObject = new TestScorm();
		$this->TestObject->Sco->useDbConfig = 'test';
		$this->TestObject->Sco->SubItem->useDbConfig = 'test';
		$this->TestObject->Sco->Objective->useDbConfig = 'test';
		$this->TestObject->Sco->PrimaryObjective->useDbConfig = 'test';
		$this->TestObject->Sco->Randomization->useDbConfig = 'test';
		$this->TestObject->Sco->Rollup->useDbConfig = 'test';
		$this->TestObject->Sco->Rule->useDbConfig = 'test';
		$this->TestObject->Sco->Rule->Condition->useDbConfig = 'test';;
		$this->TestObject->Sco->Choice->useDbConfig = 'test';
		$this->TestObject->Sco->Presentation->useDbConfig = 'test';
		$this->TestObject->Sco->ControlMode->useDbConfig = 'test';
		$this->TestObject->Sco->DeliveryControl->useDbConfig = 'test';
	}


/**Test function Validation. */
	function testValidation1() {
		$data = array();
		$this->TestObject->set($data);
		$valid = $this->TestObject->validates();
		$expectedErrors = array(
			'name'				=> 'Error.empty',
			'description'		=> 'Error.empty',
			'course_id' 		=> 'Error.empty'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}

/**Test function manifestExists.*/
	function testManifestExists() {
		$file = new File(TMP.'tests/imsmanifests/imsmanifest.xml',true);
		$this->assertTrue($this->TestObject->manifestExists(TMP.'tests'.DS.'imsmanifests'));
		$this->assertFalse($this->TestObject->manifestExists(TMP.'fake'));
		$file->delete();
	}

/**Test function parseManifest.*/
	function testParseManifest() {
		//$this->TestObject->parseManifest(TMP.'tests');
		//debug($this->TestObject->data);
	}
	
/**Test function getSchemaVersion.*/
	function testGetSchemaVersion() {
		$xml = <<<eof
			<metadata>
			    <schema>ADL SCORM</schema>
			    <schemaversion>2004 3rd Edition</schemaversion>
			  </metadata>
eof;
	$manifest = $this->TestObject->__getXMLParser();
	$manifest->load($xml);
		$this->assertEqual(
			$this->TestObject->getSchemaVersion($manifest),
			'2004 3rd Edition'
		);
	}
	
/**Test function extractResources. */
	function testExtractResources() {
		$xml = <<<eof
			<resources>
			    <resource identifier="RESOURCE1" type="webcontent" href="localitem1.html" adlcp:scormType="sco" />
			    <resource identifier="RESOURCE2" type="webcontent" href="localitem2.html" adlcp:scormType="sco" />
				<resource identifier="RESOURCE3" type="webcontent" href="localitem3.html" adlcp:scormType="sco" >
			      <file href="'localitem3.html'" />
			    </resource>
			</resources>
eof;

		$manifest = $this->TestObject->__getXMLParser();
		$manifest->load($xml);
		$this->assertEqual(
			$this->TestObject->extractResources($manifest),
			array (
				'RESOURCE1' => array (
					'identifier' => 'RESOURCE1',
					'adlcp:scormType' => 'sco',
					'type' => 'webcontent',
					'href' => 'localitem1.html',
				),
				'RESOURCE2' => array (
					'identifier' => 'RESOURCE2',
					'adlcp:scormType' => 'sco',
					'type' => 'webcontent',
					'href' => 'localitem2.html'
				),
				'RESOURCE3' => array (
					'identifier' => 'RESOURCE3',
					'adlcp:scormType' => 'sco',
					'type' => 'webcontent',
					'href' => 'localitem3.html'
				)
			)
		);
	}

/**Test function extractOrganizations. */	
	function testExtractOrganizations() {
$xml = <<<eof
	<organizations default="DMCE">
		<organization identifier="DMCE">
			<title>SCORM 2004 3rd Edition Data Model Content Example 1.1</title>
			<metadata>
				<adlcp:location>lesson1/lesson1MD.xml</adlcp:location>
			</metadata>
			<item identifier="WELCOME" isvisible="false" parameters="?width=500&#038;length=300">
				<title>Welcome</title>
				<adlcp:timeLimitAction>exit,no message</adlcp:timeLimitAction>
				<adlcp:dataFromLMS>Some SCO Information</adlcp:dataFromLMS>
				<adlcp:completionThreshold>0.75</adlcp:completionThreshold>
				<metadata>
					<adlcp:location>lesson1/lesson1MD.xml</adlcp:location>
				</metadata>
				<imsss:sequencing>
					<imsss:controlMode 
						choice="true" 
						choiceExit="true" 
						flow="true" 
						forwardOnly="false" 
						useCurrentAttemptObjectiveInfo = "false" 
						useCurrentAttemptProgressInfo = "true" />
					<imsss:sequencingRules>
						<imsss:preConditionRule>
							<imsss:ruleConditions conditionCombination="any">
							<imsss:ruleCondition 
								referencedObjective = "some_objective_ID"
								measureThreshold = "0.5000"
								operator = "noOp"
								condition = "satisfied"
								/>
								<imsss:ruleCondition 
								referencedObjective = "some_objective_ID1"
								measureThreshold = "0.8000"
								operator = "not"
								condition = "completed"
								/>
								</imsss:ruleConditions>
							<imsss:ruleAction action = "disabled"/>
						</imsss:preConditionRule>
						<imsss:postConditionRule>
							<imsss:ruleConditions>
								<imsss:ruleCondition condition="satisfied"/>
							</imsss:ruleConditions>
							<imsss:ruleAction action="exitParent"/>
						</imsss:postConditionRule>
						<imsss:exitConditionRule>
							<imsss:ruleConditions>
								<imsss:ruleCondition condition="satisfied"/>
							</imsss:ruleConditions>
							<imsss:ruleAction action="exit"/>
						</imsss:exitConditionRule>
					</imsss:sequencingRules>
					<imsss:limitConditions attemptLimit="1" attemptAbsoluteDurationLimit="4 days"/>
					<imsss:rollupRules
						rollupObjectiveSatisfied="true"
						rollupProgressCompletion="true"
						objectiveMeasureWeight = "1.0000">
						<imsss:rollupRule childActivitySet = "all" minimumCount = "0" minimumPercent = "0.0000" >
							<imsss:rollupConditions conditionCombination = "any">
								<imsss:rollupCondition condition = "attempted" operator = "noOp"/>
							</imsss:rollupConditions>
							 <imsss:rollupAction action = "completed"/>
						</imsss:rollupRule>
					</imsss:rollupRules>
					<imsss:objectives>
						<imsss:primaryObjective objectiveID = "PRIMARYOBJ" satisfiedByMeasure = "true">
							<imsss:minNormalizedMeasure>0.6</imsss:minNormalizedMeasure>
							<imsss:mapInfo
								targetObjectiveID = "obj_module_1"
								readSatisfiedStatus="false"
								readNormalizedMeasure = "false"
								writeSatisfiedStatus = "true"
								writeNormalizedMeasure="false"/>
						</imsss:primaryObjective>
						<imsss:objective satisfiedByMeasure = "false" objectiveID="obj_module_1">
							<imsss:mapInfo 
								targetObjectiveID="obj_module_1"
								readSatisfiedStatus = "false"
								readNormalizedMeasure = "false"
								writeSatisfiedStatus = "true" />
						</imsss:objective>
					</imsss:objectives>
					<imsss:randomizationControls 
							selectCount="2"
							selectionTiming="onEachNewAttempt" />
					<imsss:deliveryControls tracked = "false"/>
					<adlseq:constrainedChoiceConsiderations constrainChoice = "true" />
					<adlseq:rollupConsiderations 
						measureSatisfactionIfActive = "false"
						requiredForCompleted = "ifNotSkipped" />
				</imsss:sequencing>
				<adlnav:presentation>
					<adlnav:navigationInterface>
						<adlnav:hideLMSUI>continue</adlnav:hideLMSUI>
						<adlnav:hideLMSUI>previous</adlnav:hideLMSUI>
					</adlnav:navigationInterface>
				</adlnav:presentation>
			</item>
			<imsss:sequencing>
					<imsss:controlMode 
						choice="true" 
						choiceExit="true" 
						flow="true" 
						forwardOnly="false" 
						useCurrentAttemptObjectiveInfo = "false" 
						useCurrentAttemptProgressInfo = "true" />
					<imsss:sequencingRules>
						<imsss:preConditionRule>
							<imsss:ruleConditions conditionCombination="any">
							<imsss:ruleCondition 
								referencedObjective = "some_objective_ID"
								measureThreshold = "0.5000"
								operator = "noOp"
								condition = "satisfied"
								/>
								<imsss:ruleCondition 
								referencedObjective = "some_objective_ID1"
								measureThreshold = "0.8000"
								operator = "not"
								condition = "completed"
								/>
								</imsss:ruleConditions>
							<imsss:ruleAction action = "disabled"/>
						</imsss:preConditionRule>
						<imsss:postConditionRule>
							<imsss:ruleConditions>
								<imsss:ruleCondition condition="satisfied"/>
							</imsss:ruleConditions>
							<imsss:ruleAction action="exitParent"/>
						</imsss:postConditionRule>
						<imsss:exitConditionRule>
							<imsss:ruleConditions>
								<imsss:ruleCondition condition="satisfied"/>
							</imsss:ruleConditions>
							<imsss:ruleAction action="exit"/>
						</imsss:exitConditionRule>
					</imsss:sequencingRules>
					<imsss:limitConditions attemptLimit="1" attemptAbsoluteDurationLimit="4 days"/>
					<imsss:rollupRules
						rollupObjectiveSatisfied="true"
						rollupProgressCompletion="true"
						objectiveMeasureWeight = "1.0000">
						<imsss:rollupRule childActivitySet = "all" minimumCount = "0" minimumPercent = "0.0000" >
							<imsss:rollupConditions conditionCombination = "any">
								<imsss:rollupCondition condition = "attempted" operator = "noOp"/>
							</imsss:rollupConditions>
							 <imsss:rollupAction action = "completed"/>
						</imsss:rollupRule>
					</imsss:rollupRules>
					<imsss:objectives>
						<imsss:primaryObjective objectiveID = "PRIMARYOBJ" satisfiedByMeasure = "true">
							<imsss:minNormalizedMeasure>0.6</imsss:minNormalizedMeasure>
							<imsss:mapInfo
								targetObjectiveID = "obj_module_1"
								readSatisfiedStatus="false"
								readNormalizedMeasure = "false"
								writeSatisfiedStatus = "true"
								writeNormalizedMeasure="false"/>
						</imsss:primaryObjective>
						<imsss:objective satisfiedByMeasure = "false" objectiveID="obj_module_1">
							<imsss:mapInfo 
								targetObjectiveID="obj_module_1"
								readSatisfiedStatus = "false"
								readNormalizedMeasure = "false"
								writeSatisfiedStatus = "true" />
						</imsss:objective>
					</imsss:objectives>
					<imsss:randomizationControls 
						selectCount="2"
	                    selectionTiming="onEachNewAttempt" />
					<imsss:deliveryControls tracked = "false"/>
					<adlseq:constrainedChoiceConsiderations constrainChoice = "true" />
					<adlseq:rollupConsiderations 
					measureSatisfactionIfActive = "false"
           			requiredForCompleted = "ifNotSkipped" />
				</imsss:sequencing>
		</organization>
	</organizations>
eof;
	$parent1 = $this->TestObject->__getXMLParser();
	$parent1->load($xml);
	//debug($parent1);
	// testExtractOrganizations: falta probar <imsss:sequencing> de <organization>.
	// Sin embargo es equivalente al de <item>
	
	$sequencing = array (
						'Control' => array (
								'choice' => 'true',
								'choiceExit' => 'true',
								'flow' => 'true',
								'forwardOnly' => 'false',
								'useCurrentAttemptObjectiveInfo' => 'false',
								'useCurrentAttemptProgressInfo' => 'true',
						),
						'SequencingRule' => array (
							'Pre' => array ( 
							    0 => array(
    								'Condition' => array (
    									'conditionCombination' => 'any',
    									array (
    										'referencedObjective' => 'some_objective_ID',
    										'measureThreshold' => '0.5000',
    										'operator' => 'noOp',
    										'condition' => 'satisfied',
    									),
    									array (
    										'referencedObjective' => 'some_objective_ID1',
    										'measureThreshold' => '0.8000',
    										'operator' => 'not',
    										'condition' => 'completed',
    									)
    								),
    								'Action' => array ('action' => 'disabled',)
							    )
							),
							'Post' => array (
							    0 => array(
    								'Condition' => array (
    									array('condition' => 'satisfied')
    								),
    								'Action' => array ('action' => 'exitParent')
    							)
							),
							'Exit' => array (
							    0 => array(
    								'Condition' => array (
    									array('condition' => 'satisfied',)
    								),
    								'Action' => array('action' => 'exit',)
    							)
    						)
						),
						'LimitCondition' => array (
							'attemptLimit' => '1',
							'attemptAbsoluteDurationLimit' => '4 days',
						),
						'RollupRule' => array (
							'0' => array (
								'rollupObjectiveSatisfied' => 'true',
								'rollupProgressCompletion' => 'true',
								'objectiveMeasureWeight' => '1.0000',
    							'Condition' => array (
    								'conditionCombination' => 'any',
    								array (
    									'condition' => 'attempted',
    									'operator' => 'noOp',
    								),
    							),
    							'Action' => array ('action' => 'completed',)
							),
						),
						'Objective' => array (
							'Primary' => array (
								'objectiveID' => 'PRIMARYOBJ',
								'satisfiedByMeasure' => 'true',
								'minNormalizedMeasure' => '0.6',
								'mapInfo' => array (
									array (
										'targetObjectiveID' => 'obj_module_1',
										'readSatisfiedStatus' => 'false',
										'readNormalizedMeasure' => 'false',
										'writeSatisfiedStatus' => 'true',
										'writeNormalizedMeasure' => 'false',
									),
								),
							),
							'Objective' => array (
								array (
									'satisfiedByMeasure' => 'false',
									'objectiveID' => 'obj_module_1',
									'mapInfo' => array (
										array (
											'targetObjectiveID' => 'obj_module_1',
											'readSatisfiedStatus' => 'false',
											'readNormalizedMeasure' => 'false',
											'writeSatisfiedStatus' => 'true',
										),
									),
								),
							),
						),
						'Randomization' => array (
                            'selectCount' => '2',
                            'selectionTiming' => 'onEachNewAttempt',
                        ),
                    	'DeliveryControl' => array ( 'tracked' => 'false'),
                    	'Choice' => array ('constrainChoice' => 'true'),
                    	'Consideration' => array (
                            'measureSatisfactionIfActive' => 'false',
                            'requiredForCompleted' => 'ifNotSkipped',
                        ),
					);
	$organization = array (
		'DMCE' => array (
			'identifier' => 'DMCE',
			'title' => 'SCORM 2004 3rd Edition Data Model Content Example 1.1',
			'metadata' => 'lesson1/lesson1MD.xml',			
			'Item'=> array (
				'WELCOME' => array (
					'identifier' => 'WELCOME',
					'isvisible' => 'false',
					'parameters' => '?width=500&length=300',
					'title' => 'Welcome',
					'metadata' => 'lesson1/lesson1MD.xml',
					'timeLimitAction' => 'exit,no message',
					'dataFromLMS' => 'Some SCO Information',
					'completionThreshold' => '0.75',
					'Sequencing' => $sequencing,
					'SubItem' => array (),
					'Presentation' => array (
    					'continue',
    					'previous',
    				),
				),
			),
			'Sequencing'=> $sequencing,
		),
		
	);
	$this->assertEqual($this->TestObject->extractOrganizations($parent1),$organization);	
	}
	
/**Test function extractItems.*/	
	function testExtractItems() {
		$xml = <<<eof
		<item identifier="WELCOME1" isvisible="false" parameters="?width=500&#038;length=300">
			<title>Welcome</title>
			<metadata>
   				<adlcp:location>lesson1/lesson1MD.xml</adlcp:location>
			</metadata>
			<adlcp:timeLimitAction>exit,no message</adlcp:timeLimitAction>
			<adlcp:dataFromLMS>Some SCO Information</adlcp:dataFromLMS>
			<adlcp:completionThreshold>0.75</adlcp:completionThreshold>
			<imsss:sequencing>
			  <imsss:controlMode 
				choice="true" 
				choiceExit="true" 
				flow="true" 
				forwardOnly="false" 
				useCurrentAttemptObjectiveInfo = "false" 
				useCurrentAttemptProgressInfo = "true"
				/>
				<imsss:sequencingRules>
					<imsss:preConditionRule>
						<imsss:ruleConditions conditionCombination="any">
						<imsss:ruleCondition 
							referencedObjective = "some_objective_ID"
							measureThreshold = "0.5000"
							operator = "noOp"
							condition = "satisfied"
							/>
							<imsss:ruleCondition 
							referencedObjective = "some_objective_ID1"
							measureThreshold = "0.8000"
							operator = "not"
							condition = "completed"
							/>
							</imsss:ruleConditions>
						<imsss:ruleAction action = "disabled"/>
					</imsss:preConditionRule>
	
					<imsss:postConditionRule>
					<imsss:ruleConditions>
					 <imsss:ruleCondition condition="satisfied"/>
					</imsss:ruleConditions>
					<imsss:ruleAction action="exitParent"/>
					</imsss:postConditionRule>
					<imsss:exitConditionRule>
					<imsss:ruleConditions>
					 <imsss:ruleCondition condition="satisfied"/>
					</imsss:ruleConditions>
					<imsss:ruleAction action="exit"/>
					</imsss:exitConditionRule>
				</imsss:sequencingRules>
				<imsss:limitConditions attemptLimit="1" attemptAbsoluteDurationLimit="4 days"/>
				<imsss:rollupRules rollupObjectiveSatisfied = "true" rollupProgressCompletion = "true" objectiveMeasureWeight = "1.0000">
				<imsss:rollupRule childActivitySet = "all" minimumCount = "0" minimumPercent = "0.0000" >
						<imsss:rollupConditions conditionCombination = "any">
						<imsss:rollupCondition condition = "attempted" operator = "noOp"/>
						</imsss:rollupConditions>
				 <imsss:rollupAction action = "completed"/>
				</imsss:rollupRule>
				</imsss:rollupRules>
			<imsss:objectives>
				<imsss:primaryObjective objectiveID = "PRIMARYOBJ" satisfiedByMeasure = "true">
					<imsss:minNormalizedMeasure>0.6</imsss:minNormalizedMeasure>
					<imsss:mapInfo
						targetObjectiveID = "obj_module_1"
						readSatisfiedStatus="false"
			 	readNormalizedMeasure = "false"
			 	writeSatisfiedStatus = "true"
						writeNormalizedMeasure="false"/>
				</imsss:primaryObjective>
				<imsss:objective satisfiedByMeasure = "false" objectiveID="obj_module_1">
				<imsss:mapInfo 
						targetObjectiveID="obj_module_1"
					readSatisfiedStatus = "false"
					readNormalizedMeasure = "false"
					writeSatisfiedStatus = "true" />
				</imsss:objective>
			</imsss:objectives>
			<imsss:randomizationControls 
					selectCount="2"
                    selectionTiming="onEachNewAttempt" />
			<imsss:deliveryControls tracked = "false"/>
			<adlseq:constrainedChoiceConsiderations constrainChoice = "true" />
			<adlseq:rollupConsiderations 
					measureSatisfactionIfActive = "false"
           			requiredForCompleted = "ifNotSkipped" />
			</imsss:sequencing>
			<adlnav:presentation>
			  <adlnav:navigationInterface>
				<adlnav:hideLMSUI>continue</adlnav:hideLMSUI>
				<adlnav:hideLMSUI>previous</adlnav:hideLMSUI>
			  </adlnav:navigationInterface>
			</adlnav:presentation>
		  </item>
eof;
		$parent1 = $this->TestObject->__getXMLParser();
		$parent1->load($xml);
		$items = array (
		'WELCOME1' => array (
				'identifier' => 'WELCOME1',
				'isvisible' => 'false',
				'parameters' => '?width=500&length=300',
				'title' => 'Welcome',
				'metadata' => 'lesson1/lesson1MD.xml',
				'timeLimitAction' => 'exit,no message',
				'dataFromLMS' => 'Some SCO Information',
				'completionThreshold' => '0.75',
				'Sequencing' => array (
						'Control' => array (
								'choice' => 'true',
								'choiceExit' => 'true',
								'flow' => 'true',
								'forwardOnly' => 'false',
								'useCurrentAttemptObjectiveInfo' => 'false',
								'useCurrentAttemptProgressInfo' => 'true',
							),
						'SequencingRule' => array (
								'Pre' => array (
								    0 => array(
										'Condition' => array (
												'conditionCombination' => 'any',
													array (
														'referencedObjective' => 'some_objective_ID',
														'measureThreshold' => '0.5000',
														'operator' => 'noOp',
														'condition' => 'satisfied',
													),
	
													array (
														'referencedObjective' => 'some_objective_ID1',
														'measureThreshold' => '0.8000',
														'operator' => 'not',
														'condition' => 'completed',
													)
											),
										'Action' => array ('action' => 'disabled',)
									)
									),
								'Post' => array (
								    0 => array(
										'Condition' => array (
													array ('condition' => 'satisfied',)
											),
										'Action' => array ('action' => 'exitParent',)
									)
									),
								'Exit' => array (
								    0 => array(
										'Condition' => array (
													array ('condition' => 'satisfied',)
											),
										'Action' => array ('action' => 'exit',)
									)
									),
							),
						'LimitCondition' => array (
								'attemptLimit' => '1',
								'attemptAbsoluteDurationLimit' => '4 days',
							),
						'RollupRule' => array (
								'0' => array (
									'rollupObjectiveSatisfied' => 'true',
									'rollupProgressCompletion' => 'true',
									'objectiveMeasureWeight' => '1.0000',
    								'Condition' => array (
    										'conditionCombination' => 'any',
    											array (
    												'condition' => 'attempted',
    												'operator' => 'noOp',
    											),
    									),
    								'Action' => array ('action' => 'completed',)
								)
							),
						'Objective' => array (
								'Primary' => array (
										'objectiveID' => 'PRIMARYOBJ',
										'satisfiedByMeasure' => 'true',
										'minNormalizedMeasure' => '0.6',
										'mapInfo' => array (
													array (
														'targetObjectiveID' => 'obj_module_1',
														'readSatisfiedStatus' => 'false',
														'readNormalizedMeasure' => 'false',
														'writeSatisfiedStatus' => 'true',
														'writeNormalizedMeasure' => 'false',
													),
											),
									),
								'Objective' => array (
											array (
												'satisfiedByMeasure' => 'false',
												'objectiveID' => 'obj_module_1',
												'mapInfo' => array (
															array (
																'targetObjectiveID' => 'obj_module_1',
																'readSatisfiedStatus' => 'false',
																'readNormalizedMeasure' => 'false',
																'writeSatisfiedStatus' => 'true',
															),
													),
											),	
									),
							),
							'Randomization' => array (
		                            'selectCount' => '2',
		                            'selectionTiming' => 'onEachNewAttempt',
		                        ),
		                    	'DeliveryControl' => array ( 'tracked' => 'false'),
		                    	'Choice' => array ('constrainChoice' => 'true'),
		                    	'Consideration' => array (
		                            'measureSatisfactionIfActive' => 'false',
		                            'requiredForCompleted' => 'ifNotSkipped',
		                        ),
		                ),
				'SubItem' => array (),
				'Presentation' => array (
				    'continue',
				    'previous',
			    ),
			)
	);
		$this->assertEqual($this->TestObject->extractItems($parent1),$items);
	}
		
/**Test function extractSequencing. */
	function testExtractSequencing() {
$xml = <<<eof
<imsss:sequencing ID = "pretest">
	 <imsss:controlMode 
		choice="true" 
		choiceExit="true" 
		flow="true" 
		forwardOnly="false" 
		useCurrentAttemptObjectiveInfo = "false" 
		useCurrentAttemptProgressInfo = "true"/>
	<imsss:sequencingRules>
		<imsss:preConditionRule>
			<imsss:ruleConditions conditionCombination="any">
				<imsss:ruleCondition 
						referencedObjective = "some_objective_ID"
						measureThreshold = "0.5000"
						operator = "noOp"
						condition = "satisfied"/>
						<imsss:ruleCondition 
						referencedObjective = "some_objective_ID1"
						measureThreshold = "0.8000"
						operator = "not"
						condition = "completed"/>
				</imsss:ruleConditions>
				<imsss:ruleAction action = "disabled"/>
		</imsss:preConditionRule>
		<imsss:postConditionRule>
			<imsss:ruleConditions>
				<imsss:ruleCondition condition="satisfied"/>
			</imsss:ruleConditions>
			<imsss:ruleAction action="exitParent"/>
		</imsss:postConditionRule>
		<imsss:exitConditionRule>
			<imsss:ruleConditions>
				<imsss:ruleCondition condition="satisfied"/>
			</imsss:ruleConditions>
			<imsss:ruleAction action="exit"/>
		</imsss:exitConditionRule>
	</imsss:sequencingRules>
	<imsss:limitConditions attemptLimit="1" attemptAbsoluteDurationLimit="4 days"/>
	<imsss:rollupRules 
		rollupObjectiveSatisfied = "true" 
		rollupProgressCompletion = "true" 
		objectiveMeasureWeight = "1.0000">
		  <imsss:rollupRule 
			childActivitySet = "all" 
			minimumCount = "0" 
			minimumPercent = "0.0000">
				<imsss:rollupConditions conditionCombination = "any">
				<imsss:rollupCondition condition = "attempted" operator = "noOp"/>
				</imsss:rollupConditions>
			  	<imsss:rollupAction action = "completed"/>
		  </imsss:rollupRule>
	</imsss:rollupRules>
	<imsss:objectives>
				<imsss:primaryObjective objectiveID = "PRIMARYOBJ" satisfiedByMeasure = "true">
					<imsss:minNormalizedMeasure>0.6</imsss:minNormalizedMeasure>
					<imsss:mapInfo
						targetObjectiveID = "obj_module_1"
						readSatisfiedStatus="false"
			 	readNormalizedMeasure = "false"
			 	writeSatisfiedStatus = "true"
						writeNormalizedMeasure="false"/>
				</imsss:primaryObjective>
				<imsss:objective satisfiedByMeasure = "false" objectiveID="obj_module_1">
				<imsss:mapInfo 
						targetObjectiveID="obj_module_1"
					readSatisfiedStatus = "false"
					readNormalizedMeasure = "false"
					writeSatisfiedStatus = "true" />
				</imsss:objective>
			</imsss:objectives>
			<imsss:randomizationControls 
					selectCount="2"
                    selectionTiming="onEachNewAttempt" />
			<imsss:deliveryControls tracked = "false"/>
			<adlseq:constrainedChoiceConsiderations constrainChoice = "true" />
			<adlseq:rollupConsiderations 
					measureSatisfactionIfActive = "false"
           			requiredForCompleted = "ifNotSkipped" />
</imsss:sequencing>
eof;

	$parent1 = $this->TestObject->__getXMLParser();
	$parent1->load($xml);
	$secuencing = array (
	'Control' => array (
			'choice' => 'true',
			'choiceExit' => 'true',
			'flow' => 'true',
			'forwardOnly' => 'false',
			'useCurrentAttemptObjectiveInfo' => 'false',
			'useCurrentAttemptProgressInfo' => 'true',
		),
	'SequencingRule' => array (
			'Pre' => array (
			    0 => array(
					'Condition' => array (
							'conditionCombination' => 'any',
								array (
									'referencedObjective' => 'some_objective_ID',
									'measureThreshold' => '0.5000',
									'operator' => 'noOp',
									'condition' => 'satisfied',
									),
								array (
									'referencedObjective' => 'some_objective_ID1',
									'measureThreshold' => '0.8000',
									'operator' => 'not',
									'condition' => 'completed',
									),
						),
					'Action' => array ('action' => 'disabled',)
				)
			 ),
			'Post' => array (
			    0 => array(
					'Condition' => array (
									array ('condition' => 'satisfied',)
									),
					'Action' => array ('action' => 'exitParent',)
				)
			 ),
			'Exit' => array (
			    0 => array (
					'Condition' => array (
								array ('condition' => 'satisfied',)
								),
					'Action' => array ('action' => 'exit',)
				)
			)
		),
	'LimitCondition' => array (
			'attemptLimit' => '1',
			'attemptAbsoluteDurationLimit' => '4 days',
		),
	'RollupRule' => array (
			'0' => array (
			'rollupObjectiveSatisfied' => 'true',
			'rollupProgressCompletion' => 'true',
			'objectiveMeasureWeight' => '1.0000',
			'Condition' => array (
					'conditionCombination' => 'any',
						array (
							'condition' => 'attempted',
							'operator' => 'noOp',
						)
				),
			'Action' => array ('action' => 'completed',)
			)
		),
		'Objective' => array (
								'Primary' => array (
										'objectiveID' => 'PRIMARYOBJ',
										'satisfiedByMeasure' => 'true',
										'minNormalizedMeasure' => '0.6',
										'mapInfo' => array (
													array (
														'targetObjectiveID' => 'obj_module_1',
														'readSatisfiedStatus' => 'false',
														'readNormalizedMeasure' => 'false',
														'writeSatisfiedStatus' => 'true',
														'writeNormalizedMeasure' => 'false',
													),
											),
									),
								'Objective' => array (
											array (
												'satisfiedByMeasure' => 'false',
												'objectiveID' => 'obj_module_1',
												'mapInfo' => array (
															array (
																'targetObjectiveID' => 'obj_module_1',
																'readSatisfiedStatus' => 'false',
																'readNormalizedMeasure' => 'false',
																'writeSatisfiedStatus' => 'true',
															),
													),
											),	
									),
							),
					'Randomization' => array (
                            'selectCount' => '2',
                            'selectionTiming' => 'onEachNewAttempt',
                        ),
                    	'DeliveryControl' => array ( 'tracked' => 'false'),
                    	'Choice' => array ('constrainChoice' => 'true'),
                    	'Consideration' => array (
                            'measureSatisfactionIfActive' => 'false',
                            'requiredForCompleted' => 'ifNotSkipped',
                        ),
	);
	$this->assertEqual($this->TestObject->extractSequencing($parent1),$secuencing);
}

/**Test function extractRollupRules().*/
function testExtractRollupRules() {
$xml = <<<eof
	<imsss:rollupRules 
		rollupObjectiveSatisfied = "true" 
		rollupProgressCompletion = "true" 
		objectiveMeasureWeight = "1.0000">
		<imsss:rollupRule 
			childActivitySet = "all" 
			minimumCount = "0" 
			minimumPercent = "0.0000">
				<imsss:rollupConditions conditionCombination = "any">
					<imsss:rollupCondition condition = "attempted" operator = "noOp"/>
				</imsss:rollupConditions>
				<imsss:rollupAction action = "completed"/>
		</imsss:rollupRule>
	</imsss:rollupRules>
eof;
	$parent1 = $this->TestObject->__getXMLParser();
	$parent1->load($xml);
	$rollup_rules = array (
		'0' => array (
    		'rollupObjectiveSatisfied' => 'true',
    		'rollupProgressCompletion' => 'true',
    		'objectiveMeasureWeight' => '1.0000',
    		'Condition' => array (
    				'conditionCombination' => 'any',
    					array (
    						'condition' => 'attempted',
    						'operator' => 'noOp',
    					)
    			),
    		'Action' => array ('action' => 'completed',)
		)
	);
	$this->assertEqual($this->TestObject->extractRulesData($parent1->children,'rollup'),$rollup_rules);
}


/**Test function extractSeqRules. */

	function testExtractSeqRules() {
$xml = <<<eof
	<imsss:sequencingRules>
		<imsss:preConditionRule>
			<imsss:ruleConditions conditionCombination="any">
				<imsss:ruleCondition 
						referencedObjective = "some_objective_ID"
						measureThreshold = "0.5000"
						operator = "noOp"
						condition = "satisfied"/>
						<imsss:ruleCondition 
						referencedObjective = "some_objective_ID1"
						measureThreshold = "0.8000"
						operator = "not"
						condition = "completed"/>
				</imsss:ruleConditions>
				<imsss:ruleAction action = "disabled"/>
		</imsss:preConditionRule>
		<imsss:postConditionRule>
			<imsss:ruleConditions>
				<imsss:ruleCondition condition="satisfied"/>
			</imsss:ruleConditions>
			<imsss:ruleAction action="exitParent"/>
		</imsss:postConditionRule>
		<imsss:exitConditionRule>
			<imsss:ruleConditions>
				<imsss:ruleCondition condition="satisfied"/>
			</imsss:ruleConditions>
			<imsss:ruleAction action="exit"/>
		</imsss:exitConditionRule>
	</imsss:sequencingRules>	  	
eof;
	$parent1 = $this->TestObject->__getXMLParser();
	$parent1->load($xml);	
	$seq_rules = array (
		'Pre' => array (
		    0 => array(
				'Condition' => array (
						'conditionCombination' => 'any',
						 array (
								'referencedObjective' => 'some_objective_ID',
								'measureThreshold' => '0.5000',
								'operator' => 'noOp',
								'condition' => 'satisfied',
							),
						array (
								'referencedObjective' => 'some_objective_ID1',
								'measureThreshold' => '0.8000',
								'operator' => 'not',
								'condition' => 'completed',
							)
					),
				'Action' => array ('action' => 'disabled',)
			)
			),
		'Post' => array (
		    0 => array(
				'Condition' => array (
						array ('condition' => 'satisfied',)
					),
				'Action' => array ('action' => 'exitParent',)
				)
			),
		'Exit' => array (
		    0 => array(
				'Condition' => array (
						array ('condition' => 'satisfied',)
					),
				'Action' => array('action' => 'exit',)
			)
				)
		);
	$this->assertEqual($this->TestObject->extractSeqRules($parent1),$seq_rules);
	
	}

	/**Test function extractRulesData. */
	function testExtractRulesData() {
		$xml = <<<eof
			<imsss:preConditionRule>
				<imsss:ruleConditions conditionCombination="any">
					<imsss:ruleCondition 
						referencedObjective = "some_objective_ID"
						measureThreshold = "0.5000"
						operator = "noOp"
						condition = "satisfied"/>
					<imsss:ruleCondition 
						referencedObjective = "some_other_objective_ID"
						measureThreshold = "0.3000"
						operator = "noOp"
						condition = "satisfied"/>
					</imsss:ruleConditions>
				<imsss:ruleAction action = "disabled"/>
			</imsss:preConditionRule>
eof;
		$parent1 = $this->TestObject->__getXMLParser();
		$parent1->load($xml);
		$rules_data = array (
		    0 => array(
			'Condition' => array (
				'conditionCombination' => 'any',
				array (
					'referencedObjective' => 'some_objective_ID',
					'measureThreshold' => '0.5000',
					'operator' => 'noOp',
					'condition' => 'satisfied'
				),
				array (
					'referencedObjective' => 'some_other_objective_ID',
					'measureThreshold' => '0.3000',
					'operator' => 'noOp',
					'condition' => 'satisfied',
				)
			),
			'Action' => array (
				'action' => 'disabled',
			)
		)
		);
		$this->assertEqual($this->TestObject->extractRulesData($parent1->children,'rule'),$rules_data);
	}

	/**Test function extractObjectives. */
	function testExtractObjectives() {
		$xml = <<<eof
			<imsss:objectives>
				<imsss:primaryObjective 
						objectiveID = "PRIMARYOBJ" 
						satisfiedByMeasure = "true">
					<imsss:minNormalizedMeasure>0.6</imsss:minNormalizedMeasure>
						<imsss:mapInfo
							targetObjectiveID = "obj_module_1"
							readSatisfiedStatus="false"
							readNormalizedMeasure = "false"
							writeSatisfiedStatus = "true"
							WriteNormalizedMeasure="false"/>
				</imsss:primaryObjective>
				<imsss:objective satisfiedByMeasure = "false" objectiveID="obj_module_1">
					<imsss:mapInfo 
						targetObjectiveID="obj_module_1"
						readSatisfiedStatus = "false"
						readNormalizedMeasure = "false"
						writeSatisfiedStatus = "true" />
				</imsss:objective>
		</imsss:objectives>
eof;
	$parent1 = $this->TestObject->__getXMLParser();
	$parent1->load($xml);	
	$objectives = array (
	'Primary' => array (
			'objectiveID' => 'PRIMARYOBJ',
			'satisfiedByMeasure' => 'true',
			'minNormalizedMeasure' => '0.6',
			'mapInfo' => array (
							array (
							'targetObjectiveID' => 'obj_module_1',
							'readSatisfiedStatus' => 'false',
							'readNormalizedMeasure' => 'false',
							'writeSatisfiedStatus' => 'true',
							'WriteNormalizedMeasure' => 'false',
							)
					)	
			),
	'Objective' => array (
					array (
					'satisfiedByMeasure' => 'false',
					'objectiveID' => 'obj_module_1',
					'mapInfo' => array (
									array (
									'targetObjectiveID' => 'obj_module_1',
									'readSatisfiedStatus' => 'false',
									'readNormalizedMeasure' => 'false',
									'writeSatisfiedStatus' => 'true',
									)
								)
						)
				)
	);
	$this->assertEqual($this->TestObject->extractObjectives($parent1->children[0]),$objectives);
	}

	/**Test function extractObjectiveData. */
	function testExtractObjectiveData(){
		$xml = <<<eof
			<imsss:primaryObjective 
				objectiveID = "PRIMARYOBJ" 
				satisfiedByMeasure = "true">
					<imsss:minNormalizedMeasure>0.6</imsss:minNormalizedMeasure>
						<imsss:mapInfo
							targetObjectiveID = "obj_module_1"
							readSatisfiedStatus="false"
							readNormalizedMeasure = "false"
							writeSatisfiedStatus = "true"
							WriteNormalizedMeasure="false"/>
			</imsss:primaryObjective>
eof;
	$parent1 = $this->TestObject->__getXMLParser();
	$parent1->load($xml);
	$objective_data = array (
		'objectiveID' => 'PRIMARYOBJ',
		'satisfiedByMeasure' => 'true',
		'minNormalizedMeasure' => '0.6',
		'mapInfo' => array (
			array (
				'targetObjectiveID' => 'obj_module_1',
				'readSatisfiedStatus' => 'false',
				'readNormalizedMeasure' => 'false',
				'writeSatisfiedStatus' => 'true',
				'WriteNormalizedMeasure' => 'false'
			)
		)
	);
	$this->assertEqual(
		$this->TestObject->extractObjectiveData($parent1->children[0]),
		$objective_data
	);
}

	/**Test function extractPresentation. */
	function testExtractPresentation() {
		$xml = <<<eof
			<adlnav:presentation>
				<adlnav:navigationInterface>
					<adlnav:hideLMSUI>continue</adlnav:hideLMSUI>
					<adlnav:hideLMSUI>previous</adlnav:hideLMSUI>
				</adlnav:navigationInterface>
			</adlnav:presentation>
eof;
		$parent1 = $this->TestObject->__getXMLParser();
		$parent1->load($xml);
		$presentation = array (
			'continue', 
			'previous'
		);
		$this->assertEqual($this->TestObject->extractPresentation($parent1),$presentation);
	}

	function testSave(){
		$data['Scorm'] = array(
			'course_id'		=> 1,
			'name'		=> 'testScorm',
			'file_name'		=> 'ScromTest.zip',
			'description'	=> 'A scorm test',
			'hash'		=> 'slsdaslkfwerew498fwlw',
			'path'		=> 'a path'
		);
		$this->assertTrue($this->TestObject->parseManifest(TMP.'tests'.DS.'imsmanifests'.DS.'2'));
		$this->TestObject->save($data);
		$this->assertEqual(2,$this->TestObject->findCount());
		$this->assertEqual(324,$this->TestObject->Sco->findCount(array('scorm_id'=>$this->TestObject->getLastInsertId())));
		$this->assertEqual(2,$this->TestObject->Sco->Rule->findCount());
		$this->assertEqual(2,$this->TestObject->Sco->Rule->Condition->findCount());
		
	}
	
	function testSave2() {
		$this->TestObject = new TestScorm;
		$data['Scorm'] = array(
			'id' => 101,
			'course_id'		=> 1,
			'name'		=> 'testScorm',
			'file_name'		=> 'ScromTest.zip',
			'description'	=> 'A scorm test',
			'created'		=> '2007-1-1',
			'modified'		=> '2007-1-1',
			'hash'		=> 'slsdaslkfwerew498fwlw'
		);
		$this->TestObject->create();
		$this->assertTrue($this->TestObject->parseManifest(TMP.'tests'.DS.'imsmanifests'.DS.'1'));
		$this->TestObject->save($data);
		$this->assertEqual(1,$this->TestObject->findCount(array('id'=>101)));
		$this->assertEqual(11,$this->TestObject->Sco->findCount(array('scorm_id'=>101)));
		//TODO: Test rollup rules
		$this->assertEqual(1,1);
		
	}

	function testXMLBase() {
		$data['Scorm'] = array(
			'id' => 101,
			'course_id'		=> 1,
			'name'		=> 'testScorm',
			'file_name'		=> 'ScromTest.zip',
			'description'	=> 'A scorm test',
			'created'		=> '2007-1-1',
			'modified'		=> '2007-1-1',
			'hash'		=> 'slsdaslkfwerew498fwlw'
		);
		$this->assertTrue($this->TestObject->parseManifest(TMP.'tests'.DS.'imsmanifests'.DS.'3'));
		$this->TestObject->save($data);
		$expect = 'resources/';
		$this->TestObject->Sco->recursive = -1;
		$result = $this->TestObject->Sco->find(array('scorm_id'=>101),array('href'));
		$this->assertTrue(strncmp($expect,$result['Sco']['href'],10)==0);
	}	
}
?>
