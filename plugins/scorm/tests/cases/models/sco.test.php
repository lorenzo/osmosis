<?php 

loadModel('scorm.Sco');

class ScoTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('scorm','sco');

	function setUp() {
		$this->TestObject = new Sco();
		$this->TestObject->useDbConfig = 'test_suite';
		$this->TestObject->tablePrefix = 'test_suite_';
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
}
?>