<?php
/* SVN FILE: $Id: slug_article_fixture.php 12 2007-11-14 10:10:56Z mgiglesias $ */
/**
 * Fixture for test case in SlugBehavior.
 *
 * Go to the SlugBehavior page at Cake Syrup to learn more about it:
 *
 * http://cake-syrup.sourceforge.net/ingredients/slug-behavior
 *
 * @filesource
 * @author Mariano Iglesias
 * @link http://cake-syrup.sourceforge.net/ingredients/slug-behavior
 * @version	$Revision: 12 $
 * @license	http://www.opensource.org/licenses/mit-license.php The MIT License
 * @package app.tests
 * @subpackage app.tests.fixtures
 */

/**
 * A fixture for a testing model
 *
 * @package app.tests
 * @subpackage app.tests.fixtures
 */
class SlugArticleFixture extends CakeTestFixture {
	var $name = 'SlugArticle';
	var $fields = array(
		'id' => array('type' => 'integer', 'key' => 'primary', 'extra'=> 'auto_increment'),
		'slug' => array('type' => 'string', 'null' => false),
		'title' => array('type' => 'string', 'null' => false),
		'subtitle' => array('type' => 'string', 'null' => true),
		'body' => 'text',
		'created' => 'datetime',
		'updated' => 'datetime'
	);
	var $records = array(
		array ('id' => 1, 'slug' => 'first-article', 'title' => 'First Article', 'subtitle' => '', 'body' => 'First Article Body', 'created' => '2007-03-18 10:39:23', 'updated' => '2007-03-18 10:41:31'),
		array ('id' => 2, 'slug' => 'second-article', 'title' => 'Second Article', 'subtitle' => '', 'body' => 'Second Article Body', 'created' => '2007-03-18 10:41:23', 'updated' => '2007-03-18 10:43:31'),
		array ('id' => 3, 'slug' => 'third-article', 'title' => 'Third Article', 'subtitle' => '', 'body' => 'Third Article Body', 'created' => '2007-03-18 10:43:23', 'updated' => '2007-03-18 10:45:31')
	);
}

?>