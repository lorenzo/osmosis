<?php
App::import('Component','Placeholder');
App::import('Helper','Placeholder');
App::import('Helper','Html');
$configs =& Configure::getInstance();
$configs->pluginPaths[] = TESTS . 'fixtures' . DS .'plugins' . DS;

class PlaceholderHelperTest extends CakeTestCase {
	var $fixtures = array('app.plugin');
	
	function setUp() {
		parent::setUp();
		Router::reload();
		$configs =& Configure::getInstance();
		$configs->pluginPaths[] = TESTS . 'fixtures' . DS .'plugins' . DS;
		$this->Placeholder =& new PlaceholderHelper();
		$this->Placeholder->Html =& new HtmlHelper();
		$this->Controller =& new Controller();
		$this->Controller->Placeholder =& new PlaceholderComponent();
		$this->Controller->Placeholder->startup(&$this->Controller);
		$this->Controller->Placeholder->Plugin->useDbConfig = 'test';
		$this->View = new View($this->Controller);
		ClassRegistry::addObject('view', $this->view);	
	}

	function tearDown() {
		if (isset($this->Placeholder)) {
			unset($this->Placeholder->Html, $this->Placeholder);
		}
		unset($this->Controller, $this->View);
		ClassRegistry::removeObject('view');
	}
	
	function testRender() {
		$this->View->viewVars = array(
			'placeholders' => array(
				'menu' => array(
					'Fake' => array('cache'=>'+1 hour','data'=>array('var' => 'value'))),
				'other' => array(
					'Fake2' => array('cache'=>'+1 hour','data'=>array('var' => 'value2')))
			)
		);
		$this->assertTrue(is_a($this->Placeholder,'PlaceholderHelper'));
		$this->assertEqual('var=value',$this->Placeholder->render('menu'));
		$this->assertEqual('var=value2',$this->Placeholder->render('other'));
	}
	
	function testRenderWithPull() {
		$this->assertEqual('var=value',$this->Placeholder->render('menu'));
		$this->assertEqual('var=value',$this->Placeholder->render('other'));
	}
	
	function testRenderEmptyPlacheholder() {
		$this->assertEqual('',$this->Placeholder->render('dummy'));
	}

}
?>