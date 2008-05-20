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

/* LockerFolder Test cases generated on: 2008-04-29 15:04:25 : 1209497005*/
App::import('Model', 'Locker.LockerFolder');

class TestLockerFolder extends LockerFolder {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class LockerFolderTestCase extends CakeTestCase {
	var $LockerFolder = null;
	var $fixtures = array('plugin.locker.locker_folder', 'plugin.lockerlocker_folder', 'plugin.lockerlocker_document');

	function start() {
		parent::start();
		$this->LockerFolder = new TestLockerFolder();
	}

	function testLockerFolderInstance() {
		$this->assertTrue(is_a($this->LockerFolder, 'LockerFolder'));
	}

	function testLockerFolderFind() {
		$results = $this->LockerFolder->recursive = -1;
		$results = $this->LockerFolder->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('LockerFolder' => array(
			'id'  => 'Lorem ipsum dolor sit amet',
			'name'  => 'Lorem ipsum dolor sit amet',
			'parent_id'  => 'Lorem ipsum dolor sit amet'
			));
		$this->assertEqual($results, $expected);
	}
}
?>
