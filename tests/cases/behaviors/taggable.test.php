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

/**
 * Test case for Taggable Behavior
 *
 * @package app.tests
 * @subpackage app.tests.cases.models
 */
class TaggableTestCase extends CakeTestCase {
	/**
	 * Fixtures associated with this test case
	 *
	 * @var array
	 * @access public
	 */
	var $fixtures = array('core.image','tag','images_tag');

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
		                    'name' => 'Lorem',
							'TaggedImage' => array(
	                            'id' => 1,
	                            'image_id' => 1,
	                            'tag_id' => 1,
								'member_id' => 1
	                        )	
			            ),
						array(
			                'id' => 2,
		                    'name' => 'Impsum',
							'TaggedImage' => array(
	                            'id' => 2,
	                            'image_id' => 1,
	                            'tag_id' => 2,
								'member_id' => 1
	                        )
			            )
			        )
			);
		$this->assertEqual($result,$expected);
	}
	
	function testSave() {
		$Taggable = new TaggableBehavior;
		$image = new Image();
		$Taggable->setup($image);
		$data = array('Image' => array('name' => 'another one','tags' => 'Lorem,Impsum,Elit'));
		$image->save($data);
		$result = $image->read();
		$expected = array(
			'Image' => array('id' => 6,'name'=>'another one'),
			'Tag' => array(
		            array(
	                    'id' => 1,
	                    'name' => 'Lorem',
						'TaggedImage' => array(
                            'id' => 5,
                            'image_id' => 6,
                            'tag_id' => 1,
							'member_id' => 0
                        )
		            ),
					array(
		                'id' => 2,
	                    'name' => 'Impsum',
						'TaggedImage' => array(
                            'id' => 6,
                            'image_id' => 6,
                            'tag_id' => 2,
							'member_id' => 0
                        )
		            ),
					array(
			         	'id' => 6,
						'name' => 'Elit',
						'TaggedImage' => array(
                            'id' => 7,
                            'image_id' => 6,
                            'tag_id' => 6,
							'member_id' => 0
                        )
					)

		        )
		);
		$this->assertEqual($result,$expected);
		$result = $image->read();
		$this->assertEqual($result,$expected);
	}
	
	function testEdit() {
		$Taggable = new TaggableBehavior;
		$image = new Image();
		$Taggable->setup(&$image);
		$cosa = $image->read(null,1);
		$image->save(array('Image' => array('tags' => 'Elit','tagging_user' => 2)));
		$expected = array(
			'Image' => array(
			            'id' => 1,
			            'name' => 'Image 1'
			        ),
			'Tag' => array(
			            array(
		                    'id' => 1,
		                    'name' => 'Lorem',
							'TaggedImage' => array(
	                            'id' => 1,
	                            'image_id' => 1,
	                            'tag_id' => 1,
								'member_id' => 1
	                        )
			            ),
						array(
			                'id' => 2,
		                    'name' => 'Impsum',
							'TaggedImage' => array(
	                            'id' => 2,
	                            'image_id' => 1,
	                            'tag_id' => 2,
								'member_id' => 1
	                        )
			            ),
						array(
				         	'id' => 6,
							'name' => 'Elit',
							'TaggedImage' => array(
	                            'id' => 5,
	                            'image_id' => 1,
	                            'tag_id' => 6,
								'member_id' => 2
	                        )
						)
			        )
			);
		$result = $image->read();
		$this->assertEqual($result,$expected);
		
	}
	
	
}

?>
