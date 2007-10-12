<?php 

loadModel('scorm.Scorm');
loadModel('scorm.Sco');
loadModel('scorm.Objective');
loadModel('scorm.Randomization');
loadModel('scorm.Rollup');
loadModel('scorm.Rule');
loadModel('scorm.Condition');
loadModel('scorm.ChoiceConsideration');
loadModel('scorm.RollupConsideration');
loadModel('scorm.ScoPresentation');
loadModel('scorm.ControlMode');
loadModel('scorm.DeliveryControl');
class ScormTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('scorm',
                        	'sco',
                        	'objective',
                        	'randomization',
                        	'rollup',
                        	'rule',
							'condition',
                        	'choice_consideration',
                        	'rollup_consideration',
                        	'sco_presentation',
                        	'control_mode',
                        	'delivery_control');
	function setUp() {
		$this->TestObject = new Scorm();
		$this->TestObject->useDbConfig = 'test_suite';
		$this->TestObject->tablePrefix = 'test_suite_';
		$this->TestObject->Sco->useDbConfig = 'test_suite';
		$this->TestObject->Sco->tablePrefix = 'test_suite_';
		$this->TestObject->Sco->SubItem->useDbConfig = 'test_suite';
		$this->TestObject->Sco->SubItem->tablePrefix = 'test_suite_';
		$this->TestObject->Sco->Objective->useDbConfig = 'test_suite';
		$this->TestObject->Sco->Objective->tablePrefix = 'test_suite_';
		$this->TestObject->Sco->PrimaryObjective->useDbConfig = 'test_suite';
		$this->TestObject->Sco->PrimaryObjective->tablePrefix = 'test_suite_';
		$this->TestObject->Sco->Randomization->useDbConfig = 'test_suite';
		$this->TestObject->Sco->Randomization->tablePrefix = 'test_suite_';
		$this->TestObject->Sco->Rollup->useDbConfig = 'test_suite';
		$this->TestObject->Sco->Rollup->tablePrefix = 'test_suite_';
		$this->TestObject->Sco->Rule->useDbConfig = 'test_suite';
		$this->TestObject->Sco->Rule->tablePrefix = 'test_suite_';
		$this->TestObject->Sco->Rule->Condition->useDbConfig = 'test_suite';
		$this->TestObject->Sco->Rule->Condition->tablePrefix = 'test_suite_';
		$this->TestObject->Sco->Choice->useDbConfig = 'test_suite';
		$this->TestObject->Sco->Choice->tablePrefix = 'test_suite_';
		$this->TestObject->Sco->Presentation->useDbConfig = 'test_suite';
		$this->TestObject->Sco->Presentation->tablePrefix = 'test_suite_';
		$this->TestObject->Sco->ControlMode->useDbConfig = 'test_suite';
		$this->TestObject->Sco->ControlMode->tablePrefix = 'test_suite_';
		$this->TestObject->Sco->DeliveryControl->useDbConfig = 'test_suite';
		$this->TestObject->Sco->DeliveryControl->tablePrefix = 'test_suite_';
	}

	function tearDown() {
		unset($this->TestObject);
	}

/**Test function Validation. */
	function testValidation1() {
		$data = array();
		$this->TestObject->data = $data;
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
		uses('File');
		$file = new File(TMP.'tests/imsmanifests/imsmanifest.xml',true);
		$this->assertTrue($this->TestObject->manifestExists(TMP.'tests'));
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
		$manifest = new XMLNode('manifest');
		$metadata = new XMLNode('metadata');
		$schema = new XMLNode('schema', null, 'ADL SCORM');
		$schemaversion = new XMLNode('schemaversion', null, '2004 3rd Edition');
		$metadata->append($schemaversion);
		$metadata->append($schema);
		$manifest->append($metadata);
		$this->assertEqual(
			$this->TestObject->getSchemaVersion($manifest),
			'2004 3rd Edition'
		);
	}
	
/**Test function extractResources. */
	function testExtractResources() {
		$resources = new XMLNode('resources');
		$resource1 = new XMLNode('resource', array(
				'identifier' => 'RESOURCE1',
				'adlcp:scormType' => 'sco',
				'type' => 'webcontent',
				'href' => 'localitem1.html'
			)
		);
		$resources->append($resource1);
		$resource2 = new XMLNode('resource', array(
				'identifier' => 'RESOURCE2',
				'adlcp:scormType' => 'sco',
				'type' => 'webcontent',
				'href' => 'localitem2.html'
			)
		);
		$resources->append($resource2);
		$resource3 = new XMLNode('resource', array(
				'identifier' => 'RESOURCE3',
				'adlcp:scormType' => 'sco',
				'type' => 'webcontent',
				'href' => 'localitem3.html'
			)
		);
		$file = new XMLNode('file', array('href' => 'localitem3.html')); //Ignored
		$resource3->append($file);
		$resources->append($resource3);
		
		$manifest = new XMLNode('manifest');
		$manifest->append($resources);
		
		
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
			'description'	=> 'A scorm test_suite',
			'created'		=> '2007-1-1',
			'modified'		=> '2007-1-1',
			'hash'		=> 'slsdaslkfwerew498fwlw'
		);
		$this->assertTrue($this->TestObject->parseManifest(TMP.'tests'.DS.'imsmanifests'.DS.'2'));
		$this->TestObject->save($data);
		$this->assertEqual(2,$this->TestObject->findCount());
		$this->assertEqual(324,$this->TestObject->Sco->findCount(array('scorm_id'=>$this->TestObject->getLastInsertId())));
		$this->assertEqual(2,$this->TestObject->Sco->Rule->findCount());
		$this->assertEqual(2,$this->TestObject->Sco->Rule->Condition->findCount());
		
	}
	
	function testSave2() {
		$data['Scorm'] = array(
			'course_id'		=> 1,
			'name'		=> 'testScorm',
			'file_name'		=> 'ScromTest.zip',
			'description'	=> 'A scorm test_suite',
			'created'		=> '2007-1-1',
			'modified'		=> '2007-1-1',
			'hash'		=> 'slsdaslkfwerew498fwlw'
		);
		$this->assertTrue($this->TestObject->parseManifest(TMP.'tests'.DS.'imsmanifests'.DS.'1'));
		$this->TestObject->save($data);
		$this->assertEqual(2,$this->TestObject->findCount());
		$this->assertEqual(11,$this->TestObject->Sco->findCount(array('scorm_id'=>$this->TestObject->getLastInsertId())));
		$this->assertEqual(2,$this->TestObject->Sco->Rollup->findCount());
		
	}
}
?>
