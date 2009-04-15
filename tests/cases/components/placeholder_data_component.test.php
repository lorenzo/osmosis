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
App::import('Component','PlaceholderData');
App::import('Controller','AppController');

class DummyComponent extends PlaceHolderDataComponent {
	var $name = 'Dummy';
	var $types = array('menu');
	var $auto = true;
	
	function getData($type = null) {
		return array('var' => 'value');
	}
}

class PlaceHolderDataComponentTestCase extends CakeTestCase {
	var $TestObject = null;
	
	function setUp() {
		$this->TestObject = new DummyComponent();
		$this->TestObject->startup(new Controller);
	}
	
	function testSetData() {
		$this->assertTrue(is_a($this->TestObject->controller,'Controller'));
		$expected = array('placeholders' => array('menu' => array('Dummy' => array('cache'=>'+1 hour','data'=>array('var' => 'value')))));
		$this->assertEqual($this->TestObject->controller->viewVars,$expected);
	}

	function tearDown() {
		unset($this->TestObject);
	}
	
}
?>
