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

/* ModelLog Test cases generated on: 2008-05-13 19:05:50 : 1210721510*/
App::import('Model', 'ModelLog');

class TestModelLog extends ModelLog {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class ModelLogTestCase extends CakeTestCase {
	var $ModelLog = null;
	var $fixtures = array('app.model_log', 'app.member');

	function start() {
		parent::start();
		$this->ModelLog = new TestModelLog();
	}

	function testModelLogInstance() {
		$this->assertTrue(is_a($this->ModelLog, 'ModelLog'));
	}

	function testModelLogFind() {
		$results = $this->ModelLog->recursive = -1;
		$results = $this->ModelLog->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('ModelLog' => array(
			'id'  => 1,
			'member_id'  => 1,
			'model'  => 'Lorem ipsum dolor sit amet',
			'entity_id'  => 'Lorem ipsum dolor sit amet',
			'type'  => 'Lorem ',
			'created'  => '2008-05-13 19:01:50'
			));
		$this->assertEqual($results, $expected);
	}
}
?>
