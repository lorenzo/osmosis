<?php 
/* SVN FILE: $Id$ */
/* OnlineUser Test cases generated on: 2008-05-05 13:05:52 : 1210009732*/
App::import('Model', 'OnlineUser');

class TestOnlineUser extends OnlineUser {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class OnlineUserTestCase extends CakeTestCase {
	var $OnlineUser = null;
	var $fixtures = array('app.online_user', 'appmember');

	function start() {
		parent::start();
		$this->OnlineUser = new TestOnlineUser();
	}

	function testOnlineUserInstance() {
		$this->assertTrue(is_a($this->OnlineUser, 'OnlineUser'));
	}

	function testOnlineUserFind() {
		$results = $this->OnlineUser->recursive = -1;
		$results = $this->OnlineUser->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('OnlineUser' => array(
			'member_id'  => 1,
			'modified'  => '2008-05-05 13:48:52',
			'viewing'  => 'Lorem ipsum dolor sit amet'
			));
		$this->assertEqual($results, $expected);
	}
}
?>