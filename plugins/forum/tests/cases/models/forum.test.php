<?php 
/* SVN FILE: $Id$ */
/* Forum Test cases generated on: 2008-02-02 13:02:34 : 1201975054*/
App::import('Model', 'Forum.Forum');

class TestForum extends Forum {
	var $cacheSources = false;
	var $useDbConfig = 'test';
}

class ForumTestCase extends CakeTestCase {
	var $Forum = null;
	var $fixtures = array('forum', 'app.course', 'topic');

	function start() {
		parent::start();
		$this->Forum = new TestForum();
	}

	function testForumInstance() {
		$this->assertTrue(is_a($this->Forum, 'Forum'));
	}

	function testForumFind() {
		$results = $this->Forum->recursive = -1;
		$results = $this->Forum->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Forum' => array(
			'id'  => 1,
			'course_id'  => 1
			));
		$this->assertEqual($results, $expected);
	}
}
?>
