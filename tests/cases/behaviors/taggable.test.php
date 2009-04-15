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
 */

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
