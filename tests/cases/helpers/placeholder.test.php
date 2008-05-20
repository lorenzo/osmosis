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
