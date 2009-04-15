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
/**
 * Test order is important.
 */

App::import('Component','Placeholder');
$configs =& Configure::getInstance();
$configs->pluginPaths[] = TESTS . 'fixtures' . DS .'plugins' . DS;


class PlaceHolderComponentTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('app.plugin');
	
	function setUp() {
		$this->TestObject = new PlaceholderComponent();
		$this->TestObject->startup(new Controller);
		$this->TestObject->Plugin->useDbConfig = 'test';
	}
	
	function testAttach() {
		$this->assertTrue(is_a($this->TestObject->controller,'Controller'));
		$this->TestObject->attach(array('menu','other'));
		$this->assertEqual(array('FakeHolder','Fake2Holder'),$this->TestObject->controller->components);
		$this->assertTrue(is_a($this->TestObject->controller->FakeHolder,'FakeHolderComponent'));
		$this->assertTrue(is_a($this->TestObject->controller->Fake2Holder,'Fake2HolderComponent'));
		$expected = array(
			'placeholders' => array(
				'menu' => array(
					'FakeHolder' => array('cache'=>'+1 hour','data'=>array('var' => 'value'))),
				'other' => array(
					'Fake2Holder' => array('cache'=>'+1 hour','data'=>array('var' => 'value')))
				)
			);
		$this->assertEqual($this->TestObject->controller->viewVars,$expected);
	}

	function tearDown() {
		unset($this->TestObject);
	}
	
}
?>
