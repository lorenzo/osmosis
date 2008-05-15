<?php
App::import('Model', 'scorm.ScoPresentation');

class TestScoPresentation extends ScoPresentation {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}


class ScoPresentationTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('plugin.scorm.sco_presentation');

	function start() {
		parent::start();
		$this->TestObject = new TestScoPresentation();
	}
	
	function testInstance() {
		$this->assertTrue(is_a($this->TestObject,'ScoPresentation'));
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
			'ScoPresentation' => array(
				'hideKey'	=> 'yes',
			)
		);
		$this->TestObject->set($data);
		$valid = $this->TestObject->validates();
		$expectedErrors = array(
			'hideKey'			=> 'scormplugin.scopresentation.hidekey.token',
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testValidation3() {
		$token = array ('previous', 'continue', 'exit', 'exitAll','abandon','abandonAll','suspendAll');
		foreach ($token as &$value){
		$this->TestObject->create();
		$data = array(
			'ScoPresentation' => array(
				'hideKey' => $value,
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
    		'ScoPresentation' => array(
					'hideKey'=> 'continue',
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
