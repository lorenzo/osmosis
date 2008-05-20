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

/* Member Test cases generated on: 2008-05-14 12:05:28 : 1210782628*/
App::import('Model', 'Member');

class TestMember extends Member {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class MemberTestCase extends CakeTestCase {
	var $Member = null;
	var $fixtures = array('app.member', 'app.institution', 'app.role', 'app.forum_discussion', 'app.forum_response', 'app.locker_document', 'app.locker_folder', 'app.online_user', 'app.wiki_entry', 'app.wiki_revision', 'app.forum_discussion', 'app.forum_response', 'app.locker_document', 'app.locker_folder', 'app.online_user', 'app.wiki_entry', 'app.wiki_revision');

	function start() {
		parent::start();
		$this->Member = new TestMember();
	}

	function testMemberInstance() {
		$this->assertTrue(is_a($this->Member, 'Member'));
	}

	function testMemberFind() {
		$results = $this->Member->recursive = -1;
		$results = $this->Member->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Member' => array(
			'id'  => 1,
			'institution_id'  => 'Lorem ipsum dolor ',
			'full_name'  => 'Lorem ipsum dolor sit amet',
			'email'  => 'Lorem ipsum dolor sit amet',
			'phone'  => 'Lorem ipsum dolor ',
			'country'  => 'Lorem ipsum dolor ',
			'city'  => 'Lorem ipsum dolor sit amet',
			'age'  => 1,
			'sex'  => 'Lorem ipsum dolor sit ame',
			'role_id'  => 1,
			'username'  => 'Lorem ipsum d',
			'password'  => 'Lorem ipsum dolor sit amet'
			));
		$this->assertEqual($results, $expected);
	}
}
?>
