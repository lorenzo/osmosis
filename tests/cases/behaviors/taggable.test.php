<?php

App::import('Behavior', 'Taggable');
App::import('Model', 'Tag');

/**
 * Base model that to load Taggable behavior on every test model.
 */
class TaggableTestModel extends CakeTestModel{
	var $actsAs = array('Taggable');
}

class Image extends TaggableTestModel{
	var $name = 'Image';
}

class Article extends CakeTestModel {
	var $name = 'Article';
}

/**
 * Test case for Taggable Behavior
 *
 * @package app.tests
 * @subpackage app.tests.cases.models
 */
class TaggableTestCase extends CakeTestCase {
	var $autoFixtures = false;
	/**
	 * Fixtures associated with this test case
	 *
	 * @var array
	 * @access public
	 */
	var $fixtures = array('core.image','core.article','tag','images_tag');

	/**
	 * Method executed before each test
	 *
	 * @access public
	 */
	function setUp() {
	}

	/**
	 * Method executed after each test
	 *
	 * @access public
	 */
	function tearDown(){
	}
	
	function testObject() {
		$this->assertTrue(is_a(new TaggableBehavior,'TaggableBehavior'));
	}
	
	function testSetup() {
		$this->loadFixtures('Image','Tag', 'ImagesTag');
		$image = new Image();
		$this->assertTrue(is_a($image->TaggedImage,'Model'));
	}
	
	function testFind() {
		$this->loadFixtures('Image','Tag', 'ImagesTag');
		$Taggable = new TaggableBehavior;
		$image = new Image();
		$Taggable->setup($image);
		$result = $image->read(null,1);
		$expected = array(
			'Image' => array(
			            'id' => 1,
			            'name' => 'Image 1'
			        ),
			'Tag' => array(
			            array(
		                    'id' => 1,
		                    'name' => 'Lorem'
			                ),
						array(
			                   'id' => 2,
		                    'name' => 'Impsum'
			                )

			        )
			);
		$this->assertEqual($result,$expected);
	}
	
	function testSave() {
		$this->loadFixtures('Image','Tag', 'ImagesTag');
		$Taggable = new TaggableBehavior;
		$image = new Image();
		$Taggable->setup($image);
		$data = array('Image' => array('name' => 'another one','tags' => 'Lorem,Impsum,Elit'));
		$image->save($data);
		$result = $image->read();
		$expected = array(
			'Image' => array('id' =>6,'name'=>'another one'),
			'Tag' => array(
		            array(
	                    'id' => 1,
	                    'name' => 'Lorem',
		                ),
					array(
		                'id' => 2,
	                    'name' => 'Impsum',
		                ),
					array(
			         	'id' => 6,
						'name' => 'Elit',
						)

		        )
		);
		$this->assertEqual($result,$expected);
	}
	
	
}

?>
