<?php 
/* SVN FILE: $Id$ */
/* Subject Test cases generated on: 2008-02-02 14:02:10 : 1201975390*/
App::import('Model', 'Subject');

class TestSubject extends Subject {
	var $cacheSources = false;
}

class SubjectTestCase extends CakeTestCase {
	var $Subject = null;
	var $fixtures = array('app.subject', 'app.forum', 'app.member', 'app.discussion');

	function start() {
		parent::start();
		$this->Subject = new TestSubject();
	}

	function testSubjectInstance() {
		$this->assertTrue(is_a($this->Subject, 'Subject'));
	}

	function testSubjectFind() {
		$results = $this->Subject->recursive = -1;
		$results = $this->Subject->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Subject' => array(
			'id'  => 1,
			'title'  => 'Lorem ipsum dolor sit amet',
			'forum_id'  => 1,
			'member_id'  => 1,
			'created'  => '2008-02-02 14:03:10',
			'locked'  => 1,
			'status'  => 'Lorem ipsum dolor '
			));
		$this->assertEqual($results, $expected);
	}
}
?>