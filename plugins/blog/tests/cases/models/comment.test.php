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

App::import('Model', 'Blog.Blog');
App::import('Model', 'Blog.Post');
App::import('Model', 'Blog.Comment');

class CommentTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('blog', 'post', 'comment');

	function setUp() {
		$this->TestObject = new Comment();
		$this->TestObject->useDbConfig = 'test';
		$this->TestObject->Post->useDbConfig = 'test';
	}

	function tearDown() {
		unset($this->TestObject);
	}
	
	function testValidation1() {
		
		$data = array();
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array(	
			'comment' => 'Error.empty',
			'post_id' => 'Error.empty',
			'member_id' => 'Error.empty'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}

	function testSave(){
		$data = array(
			'comment'	=> 'A comment test_suite',
			'post_id' 		=> 'post id',
			'member_id' 	=> 'member id'
		);
		$this->TestObject->save($data);
		$id = $this->TestObject->getLastInsertId();
		$result = $this->TestObject->find(array('Comment.id'=>$id));
		$this->assertEqual(3,$this->TestObject->findCount());
		
	}

	/*
	function testMe() {
		$result = $this->TestObject->findAll();
		$expected = 1;
		$this->assertEqual($result, $expected);
	}
	*/
}
?>
