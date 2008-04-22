<?php
App::import('Component','Placeholder');
App::import('Helper','Placeholder');
App::import('Helper','Html');

$configs =& Configure::getInstance();
$configs->pluginPaths[] = TESTS . 'fixtures' . DS .'plugins' . DS;

class ContactTestController extends Controller {
	var $name = 'ContactTest';
	var $uses = null;
	var $components = array('Placeholder');
}


class PlaceholderHelperTest extends CakeTestCase {
	var $fixtures = array(null);
	
	function setUp() {
		parent::setUp();
		Router::reload();
		$this->PlaceHolder =& new PlaceholderHelper();
		$this->PlaceHolder->Html =& new HtmlHelper();
		$this->Controller =& new ContactTestController();
		$this->Controller->Placeholder = new PlaceHolderComponent();
		$this->Controller->Placeholder->startup(&$this->Controller);
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
		$this->View->data = array(
			'placeholders' => array(
				'menu' => array(
					'FakeMenu' => array('cache'=>'+1 hour','data'=>array('var' => 'value'))),
				'other' => array(
					'Fake2Other' => array('cache'=>'+1 hour','data'=>array('var' => 'value2')))
			)
		);
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