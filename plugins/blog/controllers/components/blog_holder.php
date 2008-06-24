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

App::import('Component', 'PlaceholderData');
class BlogHolderComponent extends PlaceholderDataComponent {
	var $name = 'BlogHolder';
	var $auto = true;
	var $cache = false;
	
	function head() {
		
		return $this->controller->plugin == 'blog' || $this->controller->name == 'Dashboards' && $this->controller->action == 'messages';
	}
	
	/**
	 * Set data to be used on the connectionsDashboard placeholder
	 *
	 * @return mixed Data or False if no data sent do placeholder
	 **/
	function messagesDashboard() {
		$blog = ClassRegistry::init('Blog.Blog');
		$blog->Post->Comment->contain(
			array(
				'Member' => array('id', 'full_name'),
				'Post(member_id)'
			)
		);
		$conditions = array(
			'Post.member_id' => $this->controller->Auth->user('id')
		);
		$data = $blog->Post->Comment->find('all', compact('conditions'));
		if (!$data) {
			$data = array();
		}
		return $data;
	}
}
?>