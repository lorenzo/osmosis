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
	var $helpers = array('Javascript', 'Html', 'Form', 'Time', 'Placeholder', 'Text','Filter');
	
	/**
	 * Contains the id of the course the member is visiting. False if the member is viewing a page outside a course
	 *
	 * @var mixed
	 */
	
	protected $activeCourse = false;
	
	protected $currentRole = 'Public';
	
	/**
	 * Things to be done before calling to the requested action.
	 *
	 * @see Controller::beforeFilter
	 * @return void
	 * @author José Lorenzo
	 */
	
	function beforeFilter() {
		if (isset($this->Auth)) {
			$this->_initializeAuth();
		}
		
		$this->_setActiveCourse();
		Configure::write('ActiveCourse.id', $this->activeCourse);
		
		if (isset($this->Security)) {
			$this->Security->blackHoleCallback = '_blackHoledAction';
		}
		if (isset($this->Auth) && $this->Session->valid() && $this->Auth->user())
			$this->__updateOnlineUser();
		
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
	
	/**
	 * Initializes the AuthComponent for doing authorization and athenticantion.
	 *
	 * @return void
	 */
	
	function _initializeAuth() {
		if (isset($this->Auth)) {
			$this->Auth->Acl =& $this->Acl;
			$this->Auth->authorize = 'controller';
			$this->Auth->userModel = 'Member';
			$this->Auth->loginAction = array('controller' => 'members', 'action' => 'login', 'plugin' => '', 'admin' => false);
			$this->Auth->loginError = __('Login or password incorrect', true);
			$this->Auth->loginRedirect = array('controller' => 'courses');
			// $this->Auth->autoRedirect = true;
			$this->set('user', $this->Session->read('Auth.Member'));
			//TODO: Borrar lo siguiente cuando sea el momento
			if ($this->name == 'InitAcl') {
				if(Configure::read('Auth.disabled')) {
					$this->Auth->allow();
				}
				return;
			}
			Configure::write('ActiveUser', $this->Auth->user());
		}
	}
	
	/**
	 * Returns the id of the active course (The course the user is requesting)
	 *
	 * @return mixed
	 */
	
	function _getActiveCourse() {
		return $this->activeCourse;
	}

	/**
	 * Sends data to the view correspondig to the active course.
	 *
	 * @return void
	 */
	
	function __setActiveCourseData() {
		if ($this->activeCourse) {
			$data = Cache::read('Course.'.$this->activeCourse);
			if (!$data) {
				$course = ClassRegistry::init('Course');
				$data = $course->read(null, $this->activeCourse);
				Cache::write('Course.'.$this->activeCourse,$data,60);
			}
			$this->set('course',$data);		
		}
	}
	
	/**
	 * Instatiates the ModelLog for futher use inside the application
	 *
	 * @return void
	 */
	
	function __instatiateLogger() {
		ClassRegistry::init('ModelLog');
	}
	
	/**
	 * Redirects the user to a safe location if detected a forgery
	 *
	 * @return void
	 */
	
	function _blackHoledAction() {
		$this->Session->setFlash(__('Invalid access', true), 'default', array('class' => 'error'));
		$this->redirect(array('controller' => 'members', 'action' => 'login', 'plugin' => ''));
	}
	
	/**
	 * Picks a layout based on the requested location
	 *
	 * @return void
	 */
	
	function __selectLayout() {
		if (isset($this->params['admin']) && $this->params['admin']) {
			$this->layout = 'admin';
		} elseif (empty($this->activeCourse)) {
			$this->layout = 'no_course';
		}
		if ($this->RequestHandler->isAjax()) {
			switch ($this->RequestHandler->prefers()) {
				case 'json':
				case 'xml':
					$this->layout = 'default';
					break;
				default:
					$this->layout = 'ajax';
					break;
			}
			Configure::write('debug', 0);
		}
	}
	
	/**
	 * Logs the member last seen time
	 *
	 * @return void
	 */
	
	protected function __updateOnlineUser() {
		$member = ClassRegistry::init('Member');
		$member->id = $this->Auth->user('id');
		$member->saveField('last_seen', time());
	}
	
	/**
	 * Indicates if the active user has access to the requested location
	 *
	 * @return boolean
	 */
	
	function isAuthorized() {
		if( $this->name == 'Pages')
			return true;
			
		if ($this->Auth->user('admin')) {
			$this->viewVars['Osmosis']['currentRole'] = 'Admin';
			return true;
		}
			

		$aclPrefix = 'App/';
		if (isset($this->plugin) && !empty($this->plugin))
			$aclPrefix = Inflector::camelize($this->plugin).'/';
		
		$this->currentRole = $this->_currentRole();
		$this->viewVars['Osmosis']['currentRole'] = $this->currentRole;
		$valid = $this->Auth->Acl->check($this->currentRole,$aclPrefix.$this->Auth->action()) && $this->_ownerAuthorization();
		if($valid || Configure::read('Auth.disabled'))
			return true;
			
		$this->denied = true;
		return false;
	}
	
	/**
	 * Returns the current role of the active user based on the active course, or the location the user is requesting
	 *
	 * @return string
	 */
	
	function _currentRole() {
		if (!$this->Auth->user())
			return 'Public';

		if (empty($this->activeCourse))
			return 'Member';
				
		$member = ClassRegistry::init('Member');
		return $member->role($this->Auth->user('id'),$this->activeCourse);
	}
	
	/**
	 * Returns true if the active user has access to the requested record. TO be overriden in subclasses
	 *
	 * @return boolean
	 */
	
	function _ownerAuthorization() {
		return true;
	}
	
	/**
	 * Sends data to the view needed to render some placeholders 
	 * @see Controller::beforeRender
	 *
	 * @return void
	 */
	
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
	
	/**
	 * Populates $this->activeCourse from information in the url, session, or other sources 
	 *
	 * @return void
	 */
	
	function _setActiveCourse() {
		if (isset($this->params['named']['course_id'])) {
			$this->activeCourse = $this->params['named']['course_id'];
		}
	}
	
	/**
	 * Redirects to the specified url if $condition evaluates to true
	 * and ends the excetution of the current script
	 *
	 * @param boolean $condition 
	 * @param mixel $url 
	 */
	
	function _redirectIf($condition, $url = '/') {
		if ($condition) {
			$this->Session->setFlash(__('Invalid Access', true), 'default', array('class' => 'error'));
			$this->redirect($url);
		}
	}

	/**
	 * Extend redirect to manage Ajax
	 *
	 * @return void
	 **/
	function redirect($url, $status = null, $redirect = true) {
		if ($this->RequestHandler->isAjax()) {
			$this->set('redirect', $url);
			if ($redirect && isset($this->denied)) {
				exit;
			}
		} else {
			parent::redirect($url, $status, $redirect);
		}
	}
}
?>