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
App::import('Core', 'Sanitize');
class AppController extends Controller {
	var $components = array('Acl','Auth','RequestHandler','OsmosisComponents','Placeholder');
	var $helpers = array('Javascript', 'Html', 'Form', 'Dynamicjs', 'Time', 'Placeholder', 'Text');

	/**
	 * Contains the id of the course the member is visiting. False if the member is viewing a page outside a course
	 *
	 * @var mixed
	 */
	
	protected $activeCourse = false;
	
	function beforeFilter() {
		if (isset($this->Auth)) {
			$this->Auth->Acl =& $this->Acl;
			$this->Auth->authorize = 'controller';
			$this->Auth->userModel = 'Member';
			$this->Auth->loginAction = array('controller' => 'members', 'action' => 'login', 'plugin' => '');
			$this->Auth->loginRedirect = array('controller' => 'courses');
			$this->Auth->autoRedirect = true;
			$this->set('user', $this->Session->read('Auth.Member'));
			//TODO: Borrar lo siguiente cuando sea el momento
			if(Configure::read('Auth.disabled') && $this->name == 'InitAcl') {
				$this->Auth->allow();
			}
			Configure::write('ActiveUser', $this->Auth->user());
		}
		if (isset($this->Security)) {
			$this->Security->blackHoleCallback = '_blackHoledAction';
		}
		if (isset($this->Auth) && $this->Session->valid() && $this->Auth->user())
			$this->__updateOnlineUser();
		
		$this->_setActiveCourse();
		Configure::write('ActiveCourse.id', $this->activeCourse);
		$this->__setActiveCourseData();
		$this->__instatiateLogger();
	}
	
	function _getActiveCourse() {
		return $this->activeCourse;
	}
	
	function __setActiveCourseData() {
		if ($this->activeCourse) {
			if (!$course = ClassRegistry::getObject('Course')) {
				App::import('Model', 'Course');
				$course = new Course;
				ClassRegistry::addObject('Course', $course);
			}
			$this->set('course', $course->read(null, $this->activeCourse));
		}
	}
	
	function __instatiateLogger() {
		if (!ClassRegistry::isKeySet('ModelLog')) {
			App::import('Model', 'ModelLog');
			ClassRegistry::addObject('ModelLog', new ModelLog);
		}
	}
	function _blackHoledAction() {
		$this->Session->setFlash(__('Invalid access', true));
		$this->redirect(array('controller' => 'members', 'action' => 'login', 'plugin' => ''));
	}

	function __selectLayout() {
		if (isset($this->params['admin']) && $this->params['admin']) {
			$this->layout = 'admin';
		} elseif (empty($this->activeCourse))
			$this->layout = 'no_course';
	}
	
	protected function __updateOnlineUser() {
		if (!$member = ClassRegistry::getObject('Member')) {
			App::import('Model', 'Member');
			$member = new Member;
			ClassRegistry::addObject('Member', $member);
		}
		$member->id = $this->Auth->user('id');
		$member->saveField('last_seen', time());
	}
	
	function isAuthorized() {
		if( $this->name == 'Pages')
			return true;
			
		if ($this->Auth->user('role_id') == 7) // Admin User
			return true;

		$valid = @$this->Auth->isAuthorized('actions');
		if($valid || Configure::read('Auth.disabled')) {
			return true;
		}
		return false;
	}
	
	function beforeRender() {
		if (isset($this->Placeholder->started) && $this->activeCourse);
			$this->Placeholder->attachToolbar($this->activeCourse);
		if ($this->activeCourse) 
			$this->Placeholder->attach('course_data');
		$this->__selectLayout();
	}
	
	function _setActiveCourse() {
		if (isset($this->params['named']['course_id'])) {
			$this->activeCourse = $this->params['named']['course_id'];
		}
	}
	
	function _redirectIf($condition) {
		if ($condition) {
			$this->Session->setFlash(__('Invalid Access', true));
			$this->redirect('/');
		}
	}
		
}
?>