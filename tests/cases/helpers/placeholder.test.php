<?php
App::import('Helper','Placeholder');
App::import('Helper','Html');
$configs =& Configure::getInstance();
$configs->pluginPaths[] = TESTS . 'fixtures' . DS .'plugins' . DS;

class ContactTestController extends Controller {
	var $name = 'ContactTest';
	var $uses = null;
}

class PlaceholderHelperTest extends CakeTestCase {
	var $fixtures = array(null);
	
	function setUp() {
		parent::setUp();
		Router::reload();
		$this->PlaceHolder =& new PlaceholderHelper();
		$this->PlaceHolder->Html =& new HtmlHelper();
		$this->Controller =& new ContactTestController();
		$this->View = new View($this->Controller);
		ClassRegistry::addObject('view', $this->view);
	}

	function tearDown() {
		if (isset($this->PlaceHolder)) {
			unset($this->PlaceHolder->Html, $this->PlaceHolder);
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
		$this->assertEqual('var=value',$this->PlaceHolder->render('menu'));
		$this->assertEqual('var=value2',$this->PlaceHolder->render('other'));
	}

}
?>