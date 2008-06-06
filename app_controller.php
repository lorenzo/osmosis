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
			$this->_initializeAuth();
		}
		
		$this->_setActiveCourse();
		
		if (isset($this->Security)) {
			$this->Security->blackHoleCallback = '_blackHoledAction';
		}
		if (isset($this->Auth) && $this->Session->valid() && $this->Auth->user())
			$this->__updateOnlineUser();
		
		Configure::write('ActiveCourse.id', $this->activeCourse);
		
		$this->__instatiateLogger();
		
		$this->_redirectIf(!$this->__authorizedPlugin());
	}
	
	/**
	 * Returns true if the plugin that the user is trying to access is installed and
	 * associated to the active course if there's any. Otherwise returns false
	 *
	 * @return boolean
	 */
	
	function __authorizedPlugin() {
		if (isset($this->plugin) && !empty($this->plugin)) {
			
			if ($this->name == 'Installer' && $this->Auth->user('admin')) // Verify that only admin can access this controller
				return true;
				
			$plugin = ClassRegistry::init('Plugin','Model');
			$plugID = $plugin->findByName($this->plugin);
			if (empty($plugID))
				return false;
			
			if (!empty($this->activeCourse)) {
				return $plugin->isTool($plugID['Plugin']['id'],$this->activeCourse);
			}
		}
		return true;
	}
	

	function _initializeAuth() {		
		$this->Auth->Acl =& $this->Acl;
		$this->Auth->authorize = 'controller';
		$this->Auth->userModel = 'Member';
		$this->Auth->loginAction = array('controller' => 'members', 'action' => 'login', 'plugin' => '', 'admin' => false);			
		$this->Auth->loginRedirect = array('controller' => 'courses');
		$this->Auth->autoRedirect = true;
		$this->set('user', $this->Session->read('Auth.Member'));
		//TODO: Borrar lo siguiente cuando sea el momento
		if(Configure::read('Auth.disabled') && $this->name == 'InitAcl') {
			$this->Auth->allow();
		}
		Configure::write('ActiveUser', $this->Auth->user());
	}
	
	function _getActiveCourse() {
		return $this->activeCourse;
	}
	
	function __setActiveCourseData() {
		if ($this->activeCourse) {
			$course = ClassRegistry::init('Course');
			$this->set('course', $course->read(null, $this->activeCourse));
		}
	}
	
	function __instatiateLogger() {
		ClassRegistry::init('ModelLog');
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
		$member = ClassRegistry::init('Member');
		$member->id = $this->Auth->user('id');
		$member->saveField('last_seen', time());
	}
	
	function isAuthorized() {
		if( $this->name == 'Pages')
			return true;
			
		if ($this->Auth->user('admin')) // Admin User
			return true;

		$aclPrefix = 'App/';
		if (isset($this->plugin) && !empty($this->plugin))
			$aclPrefix = Inflector::camelize($this->plugin).'/';
			
		$valid = $this->Auth->Acl->check($this->_currentRole(),$aclPrefix.$this->Auth->action()) && $this->_ownerAuthorization();
		if($valid || Configure::read('Auth.disabled'))
			return true;

		return false;
	}
	
	function _currentRole() {
		if (!$this->Auth->user())
			return 'Public';

		if (empty($this->activeCourse))
			return 'Member';
				
		$member = ClassRegistry::init('Member');
		return $member->role($this->Auth->user('id'),$this->activeCourse);
	}
	
	function _ownerAuthorization() {
		return true;
	}
	
	function beforeRender() {
		if (isset($this->Placeholder->started) && $this->activeCourse) {
			$this->Placeholder->attachToolbar($this->activeCourse);
		}
			
		if ($this->activeCourse) {
			$this->Placeholder->attach('course_data');
			$this->__setActiveCourseData();
		}
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