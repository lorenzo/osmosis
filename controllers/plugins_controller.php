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
class PluginsController extends AppController {

	var $name = 'Plugins';
	var $helpers = array('Html', 'Form');
	var $components = array('Installer','InitAcl');

	
	function admin_index() {
		$this->Plugin->recursive = 0;
		$this->set('plugins', $this->Plugin->find('all'));
		$this->set('inServer',$this->Plugin->inServer());
	}
	
	/**
	 * Marks a plugin as installed in the database. If the plugin has it own instaler controller it is called up
	 *
	 * @param string $plugin 
	 * @return void
	 */
	
	function admin_install($plugin) {
		$inServer = $this->Plugin->inServer();
		if (!$plugin || !array_key_exists(Inflector::camelize($plugin),$inServer)) {
			$this->Session->setFlash(__('Invalid Plugin.', true), 'default', array('class' => 'error'));
		}
		
		$plugin = Inflector::camelize($plugin);
		if ($this->Plugin->find('count',array('conditions' => array('name' => $plugin)))) {
			$this->Session->setFlash(__('Plugin already Installed.', true), 'default', array('class' => 'info'));
			$this->redirect(array('action'=>'index'));
		}
		
		// Check if the plugin has it's own installation method
		if (App::import('Controller',$plugin.'.'.'Installer') && method_exists('InstallerController','install')) {
			$this->redirect(array('controller' => 'installer', 'action' => 'install', 'plugin' => $plugin,'admin' => true));
			
		} else {
			if (!$this->InitAcl->loadPermissions($plugin))
				$this->Session->setFlash(__('An error occurred while setting plugin permissions',true), 'default', array('class' => 'error'));
				
			elseif (!$this->Installer->createSchema($plugin))
				$this->Session->setFlash(__('An error occurred while installing the plugin',true), 'default', array('class' => 'error'));
				
			elseif (!$this->Plugin->install($plugin)) {
				$this->Session->setFlash(__('An error ocurred while installing the plugin. Try again', true), 'default', array('class' => 'error'));
			}
				
				
			else 
				$this->Session->setFlash(__('Plugin installed',true), 'default', array('class' => 'success'));
		}
			
		$this->redirect(array('action'=>'index'));
	}
	
	function admin_uninstall($id) {
		$this->Plugin->id = $id;
		$this->_redirectIf(!$plugin = $this->Plugin->field('name'));
		// Check if the plugin has it's own installation method
		if (App::import('Controller',$plugin.'.'.'Installer') && method_exists('InstallerController','uninstall')) {
			$this->redirect(array('controller' => 'installer', 'action' => 'uninstall', 'plugin' => $plugin,'admin' => true));
		} else {
			if ($this->InitAcl->unLoadPermissions($plugin) && $this->Installer->dropSchema($plugin) && $this->Plugin->uninstall($id)) {
					$this->Session->setFlash(__('The Plugin has been uninstalled', true), 'default', array('class' => 'success'));
			} else {
				$this->Session->setFlash(__('The Plugin could not be uninstalled', true), 'default', array('class' => 'error'));
			}
		}
		$this->redirect(array('action'=>'index'));
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Plugin.', true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('plugin', $this->Plugin->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Plugin->create();
			if ($this->Plugin->save($this->data)) {
				$this->Session->setFlash(__('The Plugin has been saved', true), 'default', array('class' => 'success'));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Plugin could not be saved. Please, try again.', true), 'default', array('class' => 'error'));
			}
		}
		$availables = $this->Plugin->installable();
		$this->set(compact('availables'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Plugin', true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Plugin->save($this->data)) {
				$this->Session->setFlash(__('The Plugin has been saved', true), 'default', array('class' => 'success'));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Plugin could not be saved. Please, try again.', true), 'default', array('class' => 'error'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Plugin->read(null, $id);
		}
		$courses = $this->Plugin->Course->find('list');
		$this->set(compact('courses'));
	}

	function admin_delete($id) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Plugin', true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Plugin->del($id)) {
			$this->Session->setFlash(__('Plugin deleted', true), 'default', array('class' => 'success'));
			$this->redirect(array('action'=>'index'));
		}
	}
	
	function admin_activate($id) {
		$this->Plugin->id = $id;
		$this->_redirectIf(!$this->Plugin->exists());
		if ($this->Plugin->activate($id)) {
			$this->Session->setFlash(__('Plugin activated', true), 'default', array('class' => 'success'));
		} else {
			$this->Session->setFlash(__('Unable to activate the plugin', true), 'default', array('class' => 'error'));
		}
		$this->redirect(array('action'=>'index'));
	}
	
	function admin_deactivate($id) {
		$this->Plugin->id = $id;
		$this->_redirectIf(!$this->Plugin->exists());
		if ($this->Plugin->deactivate($id)) {
			$this->Session->setFlash(__('Plugin deactivated', true), 'default', array('class' => 'success'));
		} else {
			$this->Session->setFlash(__('Unable to deactivate plugin', true), 'default', array('class' => 'error'));
		}
		$this->redirect(array('action'=>'index'));
	}

}
?>