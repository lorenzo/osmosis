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
App::import('Model','Locker.LockerFolder');
class InstallerController extends AppController {

	var $name = 'Installer';
	var $uses = array('Plugin');
	var $components = array('Installer','InitAcl');
	
	function admin_install() {
		$this->_checkInstallation();
		
		$tmp = LockerFolder::baseDirectory(null).uniqid().'.tmp';
		if (!@touch($tmp) && @!unlink($tmp))
			$this->Session->setFlash(__d('locker','The upload directory is not writable, could not install',true), 'default', array('class' => 'error'));
		else if (!$this->InitAcl->loadPermissions('Locker'))
			$this->Session->setFlash(__d('locker','An error occurred while setting plugin permissions',true), 'default', array('class' => 'error'));
			
		elseif (!$this->Installer->createSchema('Locker'))
			$this->Session->setFlash(__d('locker','An error occurred while installing the plugin',true), 'default', array('class' => 'error'));
			
		elseif (!$this->Plugin->install('Locker')) 
			$this->Session->setFlash(__d('locker','An error ocurred while installing the plugin. Try again', true), 'default', array('class' => 'error'));	
	}
	
	function _checkInstallation() {
		if ($this->Plugin->find('count',array('conditions' => array('name' => 'Locker')))) {
			$this->Session->setFlash(__d('locker','Plugin already Installed.', true), 'default', array('class' => 'info'));
			$this->redirect(array('controller' => 'plugins','action' => 'index', 'plugin' => '', 'admin' => true));
		}
	}

}
?>
