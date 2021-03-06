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
App::import('Component','Zip');

class ZipComponentTestCase extends CakeTestCase {
	var $TestObject = null;
	var $temp_dir = null;
	
	function setUp() {
		$this->temp_dir = TMP . 'tests' . DS . 'zip' . DS;
		$this->TestObject = new ZipComponent();
		$this->TestObject->startup($dummy);
	}

	/**
	 * Deletes all files created.
	 */
	function tearDown() {
		shell_exec('rm -rf ' . $this->temp_dir );
		unset($this->TestObject);
	}
	
	/**
	 * Creates the temporary directory to wich the test generates the zip files
	 */
	function _createTempDir() {
		$out = shell_exec('mkdir ' . $this->temp_dir);
		if (!is_dir($this->temp_dir))
			die('Your tmp directory is NOT writable.');
	}
	
	/**
	 * Creates a test zip file and adds a file to it, changing its name.
	 */
	function _createDummyZip() {
		$this->_createTempDir();
		$this->TestObject->begin($this->temp_dir . 'prueba.zip');
		shell_exec('echo test > ' . $this->temp_dir . 'test.txt');
		$this->TestObject->addFile($this->temp_dir . 'test.txt', 'other_name.txt');
		$this->TestObject->close();
		file_exists($this->temp_dir . 'prueba.zip');
		shell_exec('rm -f ' . $this->temp_dir . 'test.txt');
		$this->assertTrue(file_exists($this->temp_dir . 'prueba.zip'));
	}
	
	/**
	 * Unzips the dummy zip file to a unexistant directory.
	 * Test for the creation of the directory and de extracion of the file.
	 */
	function _unzipDummyZip() {
		$this->TestObject->begin($this->temp_dir . 'prueba.zip');
		$this->TestObject->extract($this->temp_dir . 'unexistant_path');
		$this->TestObject->close();
		$this->assertTrue(is_dir($this->temp_dir . 'unexistant_path'));
		$this->assertTrue(file_exists($this->temp_dir. 'unexistant_path' . DS . 'other_name.txt'));
		
	}

	/**
	 * Test creating a zip file, adding a file by content and then extracting
	 * it to an unexistant directory.
	 */
	function _testAddByContent(){
		$this->TestObject->begin($this->temp_dir . 'prueba.zip');
		$this->TestObject->addByContent('another_file.txt', 'Hello World');
		$this->TestObject->close();
		
		$this->TestObject->begin($this->temp_dir . 'prueba.zip');
		$this->TestObject->extract($this->temp_dir . 'another_unexistant_path');
		$this->TestObject->close();
		
		$this->assertTrue(is_dir($this->temp_dir . 'another_unexistant_path'));
		$this->assertTrue(file_exists($this->temp_dir. 'another_unexistant_path' . DS . 'other_name.txt'));	
		$this->assertTrue(file_exists($this->temp_dir. 'another_unexistant_path' . DS . 'another_file.txt'));
	}
	
	/**
	 * Test renaming a file inside the zip archive.
	 */
	function _testRenaming() {
		$this->TestObject->begin($this->temp_dir . 'prueba.zip');
		$this->TestObject->rename('other_name.txt', 'new_name.file.txt');
		$this->TestObject->close();

		$this->TestObject->begin($this->temp_dir . 'prueba.zip');
		$this->TestObject->extract($this->temp_dir . 'renaming');
		$this->TestObject->close();
		
		$this->assertTrue(file_exists($this->temp_dir . 'renaming' . DS . 'new_name.file.txt'));
	}
	
	/**
	 * Runs the tests.
	 * Test order is important.
	 */
	function testArchiveExtract() {
		$this->_createDummyZip();
		$this->_unzipDummyZip();
		$this->_testAddByContent();
		$this->_testRenaming();
	}
}
?>
