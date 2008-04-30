<?php 
/* SVN FILE: $Id$ */
/* Topic Test cases generated on: 2008-02-02 14:02:10 : 1201975390*/
App::import('Model', 'Topic');

class TestTopic extends Topic {
	var $cacheSources = false;
}

class TopicTestCase extends CakeTestCase {
	var $Topic = null;
	var $fixtures = array('app.topic', 'app.forum', 'app.member', 'app.discussion');

	function start() {
		parent::start();
		$this->Topic = new TestTopic();
	}

	function testTopicInstance() {
		$this->assertTrue(is_a($this->Topic, 'Topic'));
	}

	function testTopicFind() {
		$results = $this->Topic->recursive = -1;
		$results = $this->Topic->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Topic' => array(
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