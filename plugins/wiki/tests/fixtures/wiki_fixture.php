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

/* WikiWiki Fixure generated on: 2008-05-14 12:05:14 : 1210783754*/

class WikiFixture extends CakeTestFixture {
	var $name = 'Wiki';
	var $table = 'wiki_wikis';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
			'course_id' => array('type'=>'integer', 'null' => false),
			'name' => array('type'=>'string', 'null' => false),
			'description' => array('type'=>'text', 'null' => false),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $records = array(array(
			'id'  => 1,
			'course_id'  => 1,
			'name'  => 'Lorem ipsum dolor sit amet',
			'description'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,
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
									feugiat lacinia mauris sed, lacinia et felis.'
			));
}
?>
