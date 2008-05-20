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

App::import('Behavior', 'Hookable');
App::import('Model', 'Member');
$configs =& Configure::getInstance();
$configs->pluginPaths[] = TESTS . 'fixtures' . DS .'plugins' . DS;

class HookableModel extends CakeTestModel {
	var $name = 'HookableModel';
	var $useTable = 'hookables';
	var $cacheQueries = false;
	var $actsAs = array('Hookable');
}
/**
 * Test case for Hookable Behavior
 *
 */
class HookableTestCase extends CakeTestCase {
	/**
	 * Fixtures associated with this test case
	 *
	 * @var array
	 * @access public
	 */
	var $fixtures = array('hookable_model');
	
	function setUp() {
		
	}
	
	function tearDown() {
		unset($this->Model);
		ClassRegistry::flush();
	}
	
	function testBeforeValidate() {
		$this->Model =& new HookableModel();
		$hookable =& new HookableBehavior();
		$data = array('HookableModel' => array(
			'locale' => 'eng',
			'model'	=> 'AModel',
			)
		);
		$this->Model->set($data);
		
		$hookable->beforeValidate($this->Model);
		$data = array('HookableModel' => array(
			'locale' => 'esp',
			'model'	=> 'AnotherModel',
			)
		);
		$this->assertEqual($this->Model->data,$data);
	}
	
	function testBeforeSave() {
		$this->Model =& new HookableModel();
		$data = array('HookableModel' => array(
			'locale' => 'eng',
			'model'	=> 'AModel',
			)
		);
		$data = array('HookableModel' => array(
			'locale' => 'esp',
			'model'	=> 'AnotherModel',
			'foreign_key' => '1',
			'field' => 'afield',
			'content' => 'Some content'
			)
		);
		$result = $this->Model->save($data);
		$data['Assoc']['title'] = 'a new assoc';
		$data['HookableModel']['newfield'] = 'a new field';
		$this->assertEqual($data,$result);
	}
	
	function testBeforeFind() {
		$this->Model =& new HookableModel();
		$this->Model->find('all');
	}
	
	function testBeforeDelete() {
		$this->Model =& new HookableModel();
		$this->Model->del(1);
	}
	
	function testAfterSave() {
		$this->Model =& new HookableModel();
		$this->Model->save(array());
	}
	function testAfterFind() {
		$this->Model =& new HookableModel();
		$this->Model->find('all');
	}
	
	function testAfterDelete() {
		$this->Model =& new HookableModel();
		$this->Model->del(1);
	}
	
}

?>
