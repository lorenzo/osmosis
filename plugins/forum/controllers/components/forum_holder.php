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

class ForumHolderComponent extends PlaceholderDataComponent {
	var $name = 'ForumHolder';
	var $auto = true;
	var $cache = false;
	var $types = array('head','course_toolbar');
	var $useful_fields = array(
		'Topic' => array(
			'fields' => array(),
			'contain' => false
		),
		'Discussion' => array(
			'fields' =>  array('Discussion.id', 'Discussion.title', 'Discussion.status'),
			'contain' => false
		),
		'Response' => array(
			'fields' => array(),
			'contain' => array('Discussion'),
			'order_by' => '/Discussion/id'
		)
	);
	
	function head() {
		return $this->controller->plugin == 'forum' || ($this->controller->name == 'Courses' && $this->controller->action =='index');
	}
	
	function courseToolbar() {
		return array('url' =>
			array(
				'plugin'	=> 'forum',
				'controller'=> 'topics',
				'action'	=> 'index',
				'course_id' => $this->controller->_getActiveCourse()
			)
		);
	}
	
	/**
	 * Returns this plugin updates so that the plugin_updates element can show them.
	 *
	 * @return mixed log of changes related to this plugin.
	 **/
	function pluginUpdates() {
		$modelLog = ClassRegistry::getObject('ModelLog');
		$user_courses = $modelLog->Member->courses($this->controller->Auth->user('id'));
		$user_courses = Set::extract('/Course/id', $user_courses);
			$logs = $modelLog->find('log',
				array('models' => $this->useful_fields,'plugin' => 'Forum','course_id' => $user_courses)
			);
		return $logs;
	}
	
}
?>
