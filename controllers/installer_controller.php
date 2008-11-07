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
App::import('core', 'ConnectionManager');
class InstallerController extends Controller {
	var $uses = null;
    var $components = null;
	var $config_file_location;
	var $helpers = array('Javascript', 'Html', 'Form');
	
	function beforeFilter() {
		$this->config_file_location = CONFIGS . 'database.php';
		$this->components = array('Session');
		App::import('Component','Session');
		$this->Session = new SessionComponent();
		// $this->Session->delete('Message.flash');
	}
	
	function beforeRender() {}
	function afterFilter() {}

	function index($step = 'start') {
		$valid_steps = array(
			'database_info',
			'load_database',
			'configure_users'
		);
		if (!in_array($step, $valid_steps)) {
			$this->redirect(array('action' => 'index', $valid_steps[0]));
		}
		$this->{$step}();
		$this->render($step, 'install');
	}
	
	function database_info() {		
		if (!empty($this->data)) {
			@$db = &ConnectionManager::create('default',
				array(
					'driver'		=> $this->data['Installer']['driver'],
					'persistent'	=> false,
					'host'			=> $this->data['Installer']['host'],
					'port'			=> $this->data['Installer']['port'],
					'login'			=> $this->data['Installer']['dbusername'],
					'password'		=> $this->data['Installer']['dbpassword'],
					'database'		=> $this->data['Installer']['name'],
					'schema'		=> '',
					'prefix'		=>  $this->data['Installer']['prefix'],   
					'encoding'		=> 'UTF-8'
				)
			);
			if ($db->connected) {
				$config = $this->__createDatabaseConfiguration($db->config);
				if (file_exists($this->config_file_location)) {
					$this->load_database(false);
				} else {
					$this->Session->setFlash(
						__('Database configuration file not writable.',true),
						'default', array('class' => 'error')
					);
					$this->set('dbFileNotWritable', $config);
					$this->set('dbConfigFile', $this->config_file_location);
				}
			} else {
				$this->Session->setFlash(
					__('Could not connect to the database with the configuration given', true),
					'default', array('class' => 'error')
				);
			}
		}
		$drivers =	array(
			'mysql' => 'MySQL',
			'postgres' => 'PostgreSQL'
		);
		$this->set(compact('drivers'));
	}
	
	function load_database($requested = true) {
		if ($requested && !file_exists($this->config_file_location)) {
			$this->Session->setFlash(
				__('Database configuration file not found.',true),
				'default', array('class' => 'error')
			);
			$this->redirect(array('action' => 'index', 'database_info'));
		}
		App::import('Component', 'Installer');
		$installer = new InstallerComponent();
		$installer->startup(&$this);
		if (!$installer->createSchema()) {
			$message = __('The user does not have enough privileges over the database', true);
			foreach ($installer->errors as $error_message) {
				if (strstr($error_message, 'already exists')) {
					$message = __('The selected database is not empty. Some tables already exist.', true);
					break;
				}
			}
			@unlink($this->config_file_location);
			$this->Session->setFlash(
				$message,
				'default', array('class' => 'error')
			);
			if ($requested) {
				$this->redirect(array('action' => 'index', 'database_info'));
			}
		} else {
			$this->redirect(array('action' => 'index', 'configure_users'));
		}
	}

	function configure_users() {
		if (!file_exists($this->config_file_location)) {
			$this->redirect(array('action' => 'index'));
		}
		App::import('Component', 'Auth');
		App::import('Component', 'InitAcl');
		App::import('Component', 'Acl');
		App::import('Model', 'Member');
		App::import('Model', 'Role');
		App::import('Model', 'Aro');
		$initAcl = new InitAclComponent();
		$initAcl->Acl = new AclComponent();
		$initAcl->Member = new Member();
		$initAcl->Role = new Role();
		$initAcl->Role->Aro = new Aro();
		$initAcl->deleteDB();
		$initAcl->Auth = new AuthComponent();
		$public_id = $initAcl->initRole('Public');
		$member_id = $initAcl->initRole('Member', $public_id);
		$attendee_id = $initAcl->initRole('Attendee', $member_id);
		$helper_id = $initAcl->initRole('Assistant', $attendee_id);
		$professor_id = $initAcl->initRole('Professor', $helper_id);
		$creator_id = $initAcl->initRole('Owner', $professor_id);
		$member = array('Member' => 
			array(
				'institution_id'=> '00-00000',
				'full_name'	=> 'Administrator',
				'email'		=> 'admin@root.com',
				'phone'		=> '000000000',
				'country'	=> 'Venezuela',
				'city'		=> 'Caracas',
				'sex'		=> 'M',
				'username'	=> 'admin',
				'password'	=> 'admin',
				'password_confirm'	=> 'admin',
				'admin'		=> 1
    		)
		);
		$member_id = $initAcl->initMember($member);
		$initAcl->loadPermissions();
		$this->set(compact('member'));
	}
	
	function __createDatabaseConfiguration($configs) {
		unset($configs['connect']);
		unset($configs['schema']);
		$config = 'var $default = ' . var_export($configs, true);
		$config = str_replace("\n", "\n\t", $config);
		$config = "<?php\nclass DATABASE_CONFIG {\n\t$config;\n}\n?>";
		App::import('Core', 'File');
		$config_file = new File($this->config_file_location);
		if (($config_file->exists() && $config_file->writable()) || $config_file->create()) {
			$config_file->write($config);
			$config_file->close();
		}
		return $config;
	}
}
?>