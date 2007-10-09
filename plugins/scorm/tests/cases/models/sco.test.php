<?php 

loadModel('scorm.Sco');
loadModel('scorm.Objective');
loadModel('scorm.Randomization');
loadModel('scorm.Rollup');
loadModel('scorm.Rule');
loadModel('scorm.Condition');
class ScoTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('scorm','sco','objective','randomization','rollup','rule');

	function setUp() {
		$this->TestObject = new Sco();
		$this->TestObject->useDbConfig = 'test_suite';
		$this->TestObject->tablePrefix = 'test_suite_';
		$this->TestObject->SubItem->useDbConfig = 'test_suite';
		$this->TestObject->SubItem->tablePrefix = 'test_suite_';
		$this->TestObject->Objective->useDbConfig = 'test_suite';
		$this->TestObject->Objective->tablePrefix = 'test_suite_';
		$this->TestObject->PrimaryObjective->useDbConfig = 'test_suite';
		$this->TestObject->PrimaryObjective->tablePrefix = 'test_suite_';
		$this->TestObject->Randomization->useDbConfig = 'test_suite';
		$this->TestObject->Randomization->tablePrefix = 'test_suite_';
		$this->TestObject->Rollup->useDbConfig = 'test_suite';
		$this->TestObject->Rollup->tablePrefix = 'test_suite_';
		$this->TestObject->Rule->useDbConfig = 'test_suite';
		$this->TestObject->Rule->tablePrefix = 'test_suite_';
	}

	function tearDown() {
		unset($this->TestObject);
	}

	function testValidation1() {
		$data = array();
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array(
    		'manifest'			=> 'scormplugin.sco.manifest.empty',
    		'organization'		=> 'scormplugin.sco.organization.empty',
    		'identifier'		=> 'scormplugin.sco.identifier.empty',
    		'title'				=> 'scormplugin.sco.title.empty',
    		'scormType'			=> 'scormplugin.sco.scormtype.token'
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
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array(
    		'completionThreshold'			=> 'scormplugin.sco.completionthreshold.decimal',
    		'parameters'					=> 'scormplugin.sco.parameters.empty',
    		'isvisible'						=> 'scormplugin.sco.isvisible.boolean',
    		'attemptAbsoluteDurationLimit'	=> 'scormplugin.sco.attemptabsolutedurationlimit.empty',
    		'attemptLimit'					=> 'scormplugin.sco.attemptlimit.integer',
    		'dataFromLMS'					=> 'scormplugin.sco.datafromlms.empty',
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
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array();
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testSave() {
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
		$this->TestObject->save($data);
		$this->assertEqual(2,$this->TestObject->findCount());
	}
	
	function testSave2() {
		$data = array();
		$data['Sco'] = array(
    		'manifest'			=> 'ASDGSDS-SDFSADAS',
    		'organization'		=> 'DMCQ',
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
    		'manifest'			=> 'ASDGSDS-SDFSADAS',
    		'organization'		=> 'DMCQ',
    		'identifier'		=> 'CDADASA-GSDGDEG-WEER-SDSDSD',
    		'href'				=> 'index.html',
    		'title'				=> 'Second sco',
    		'parameters'		=> 'pa=13&f=5',
    		'scormType'			=> 'sco'
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
		$data['Rule'][] = array(
			'type'				=> 'pre',
			'conditionCombination'	=> 'any',
			'action'				=> 'disabled',
			'minimumPercent'		=> '0.0000',
			'minimumCount'			=> '1'
		);
		$data['Rule'][] = array(
			'type'				=> 'post',
			'conditionCombination'	=> 'any',
			'action'				=> 'disabled',
			'minimumPercent'		=> '0.0000',
			'minimumCount'			=> '1'
		);
		$this->TestObject->save($data);
		$this->assertEqual(3,$this->TestObject->findCount());
		$results = $this->TestObject->findById($this->TestObject->getLastInsertId());
		$this->assertEqual(1,count($results['SubItem']));
		$this->assertEqual(2,count($results['Objective']));
		$this->assertFalse(empty($results['PrimaryObjective']));
		$this->assertFalse(empty($results['Randomization']));
		$this->assertEqual(2,count($results['Rule']));
	}
}
?>
