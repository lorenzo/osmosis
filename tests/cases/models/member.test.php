<?php 
/* SVN FILE: $Id$ */
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