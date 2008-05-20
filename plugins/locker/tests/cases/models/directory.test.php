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

/* Directory Test cases generated on: 2008-04-29 00:04:07 : 1209445027*/
App::import('Model', 'Locker.Directory');

class TestDirectory extends Directory {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class DirectoryTestCase extends CakeTestCase {
	var $Directory = null;
	var $fixtures = array('plugin.locker.directory', 'plugin.lockerdocument');

	function start() {
		parent::start();
		$this->Directory = new TestDirectory();
	}

	function testDirectoryInstance() {
		$this->assertTrue(is_a($this->Directory, 'Directory'));
	}

	function testDirectoryFind() {
		$results = $this->Directory->recursive = -1;
		$results = $this->Directory->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Directory' => array(
			'id'  => 'Lorem ipsum dolor sit amet',
			'name'  => 'Lorem ipsum dolor sit amet'
			));
		$this->assertEqual($results, $expected);
	}
}
?>
