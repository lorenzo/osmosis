<?php 
/* SVN FILE: $Id$ */
/* WikiEntry Test cases generated on: 2008-05-14 12:05:57 : 1210781877*/
App::import('Model', 'Wiki.Entry');

class TestWikiEntry extends Entry {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class WikiEntryTestCase extends CakeTestCase {
	var $WikiEntry = null;
	var $fixtures = array('plugin.wiki.entry', 'plugin.wiki.wiki', 'member','plugin.wiki.revision');

	function start() {
		parent::start();
		$this->WikiEntry = new TestWikiEntry();
		$this->WikiEntry->Revision->useDbConfig = 'test_suite';
		$this->WikiEntry->Wiki->useDbConfig = 'test_suite';
		$this->WikiEntry->Member->useDbConfig = 'test_suite';
	}

	function testWikiEntryInstance() {
		$this->assertTrue(is_a($this->WikiEntry, 'Entry'));
	}

	function testWikiEntryFind() {
		$results = $this->WikiEntry->recursive = -1;
		$results = $this->WikiEntry->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Entry' => array(
			'id'  => 1,
			'wiki_id'  => 1,
			'member_id'  => 1,
			'title'  => 'Lorem ipsum dolor sit amet',
			'content'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,
									phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,
									vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,
									feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.
									Orci aliquet, in lorem et velit maecenas luctus, wisi nulla at, mauris nam ut a, lorem et et elit eu.
									Sed dui facilisi, adipiscing mollis lacus congue integer, faucibus consectetuer eros amet sit sit,
									magna dolor posuere. Placeat et, ac occaecat rutrum ante ut fusce. Sit velit sit porttitor non enim purus,
									id semper consectetuer justo enim, nulla etiam quis justo condimentum vel, malesuada ligula arcu. Nisl neque,
									ligula cras suscipit nunc eget, et tellus in varius urna odio est. Fuga urna dis metus euismod laoreet orci,
									litora luctus suspendisse sed id luctus ut. Pede volutpat quam vitae, ut ornare wisi. Velit dis tincidunt,
									pede vel eleifend nec curabitur dui pellentesque, volutpat taciti aliquet vivamus viverra, eget tellus ut
									feugiat lacinia mauris sed, lacinia et felis.',
			'revision'  => 1,
			'created'  => '2008-05-14 12:17:57',
			'updated'  => '2008-05-14 12:17:57',
			'slug'  => 'Lorem_ipsum_dolor_sit_amet'
			));
		$this->assertEqual($results, $expected);
	}
	
	function testValidation1() {
		$data['Entry'] = array(
			'wiki_id' => '',
			'member_id' => '',
			'title' => '',
			'content' => ''
		);
		$this->WikiEntry->data = $data;
		$valid = $this->WikiEntry->validates();
		$expectedErrors = array(
			'wiki_id' => 'Error.empty',
			'member_id' => 'Error.empty',
			'title' => 'Error.empty',
			'content' => 'Error.empty'
			);
		$this->assertEqual($this->WikiEntry->validationErrors, $expectedErrors);
	}
	
	function testSave() {
		$data['Entry'] = array(
			'wiki_id' => 1,
			'member_id' => 1,
			'title' => 'An entry',
			'content' => 'Some content'
		);
		$this->WikiEntry->save($data);
		$id = $this->WikiEntry->getLastInsertId();
		$result = $this->WikiEntry->find('first',array('Entry.id'=>$id));
		$this->assertTrue(empty($result['Revision']));
		$entry = $result['Entry'];
		unset($entry['id']);
		unset($entry['created']);
		unset($entry['updated']);
		$this->assertEqual($entry['revision'],1);
		unset($entry['revision']);
		$data['Entry']['slug'] = 'an_entry';
		$this->assertEqual($entry,$data['Entry']);
		
		$new_data['Entry'] = array(
			'id' => $this->WikiEntry->getLastInsertId(),
			'wiki_id' => 2,
			'member_id' => 2,
			'title' => 'Trying to change the title, hihihi, I am bad',
			'content' => 'Some content with new words'
		);
		$this->WikiEntry->save($new_data);
		$this->WikiEntry->recursive = 1;
		$new_result = $this->WikiEntry->find('first',array('Entry.id'=>$id));
		$edit = $new_result['Entry'];
		unset($edit['created']);
		$updated = $edit['updated'];
		unset($edit['updated']);
		$new_data['Entry']['revision'] = 2;
		// Unchanged wiki id
		$new_data['Entry']['wiki_id'] = 1;
		// Unchanged title
		$new_data['Entry']['title'] = 'An entry';
		unset($edit['modified']);
		$new_data['Entry']['slug'] = 'an_entry';
		$this->assertEqual($edit,$new_data['Entry']);
		
		//Test there is a revision corresponding to the first insert
		$revision = $new_result['Revision'][0];
		unset($revision['id']);
		$expected = $data['Entry'];
		unset($expected['wiki_id']);
		$expected['entry_id'] = $id;
		$expected['revision'] = 1; 
		$expected['created'] = $updated;
		unset($expected['slug']);
		$this->assertEqual($revision,$expected);
		
		//Finally check that another edit means a new revision
		$data['Entry'] = array(
			'id' => $id,
			'member_id' => 2,
			'content' => 'Some content with new words added'
		);
		$this->WikiEntry->save($data);
		$this->WikiEntry->recursive = 1;
		$result = $this->WikiEntry->find('first',array('Entry.id'=>$id));
		$this->assertEqual(2,count($result['Revision']));
	}
	
	/**
	 * Proves that an entry edit with no changes added means no new revisions
	 */
	
	function testSave2() {
		$data = $this->WikiEntry->find('first',array('Entry.id'=>1));
		$this->WikiEntry->save($data);
		$this->WikiEntry->recursive = 1;
		$result = $this->WikiEntry->find('first',array('Entry.id'=>1));
		$this->assertEqual(1,count($result['Revision']));
	}
	
	/**
	 * Tests restore function
	 */
	function testRestore() {
		$data = $this->WikiEntry->find('first',array('Entry.id'=>1));
		$content = $data['Entry']['content'];
		$data['Entry']['content'] = 'A very different content';
		$this->WikiEntry->save($data);
		$this->WikiEntry->restore(1);
		$result = $this->WikiEntry->find('first',array('Entry.id'=>1));
		$expected = $data['Entry'];
		$expected['content'] = $content;
		$expected['revision'] = 3;
		unset($expected['updated']);
		unset($result['Entry']['updated']);
		$this->assertEqual($expected,$result['Entry']);
	}
}
?>