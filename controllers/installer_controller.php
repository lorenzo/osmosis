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
	var $current_step;
	var $current_step_position = 0;
	var $current_step_name;
	var $valid_steps;
	
	function beforeFilter() {
		$this->valid_steps = array(
			'database_info'		=> __('Database Info', true),
			'load_database'		=> false,
			'configure_mailing' => __('Configure Mailing', true),
			'init_acl'			=> __('Done!', true)
		);
		$this->config_file_location = CONFIGS . 'database.php';
		$this->components = array('Session');
		App::import('Component','Session');
		$this->Session = new SessionComponent();
	}
	
	/**
	 * Dispatcher function that calls the actual step action.
	 *
	 * @param string $step step name
	 * @return void
	 */
	function index($step = 'start') {
		$steps = array_keys($this->valid_steps);
		if (!in_array($step, $steps)) {
			$this->redirect(array('action' => 'index', $steps[0]));
		}
		foreach ($steps as $pos => $_step) {
			if ($_step == $step) {
				$this->current_step_position = $pos;
				$this->current_step_name = $this->valid_steps[$_step];
				break;
			}
		}
		if ($step != $steps[0] && !file_exists($this->config_file_location)) {
			$this->Session->setFlash(
				__('Database configuration file not found.',true),
				'default', array('class' => 'error')
			);
			$this->redirect(array('action' => 'index'));
		}
		$this->current_step = $step;
		$this->set('current_step_name', $this->current_step_name);
		$this->set('current_step', $this->current_step);
		$this->set('current_step_position', $this->current_step_position+1);
		$this->{$step}();
		$this->render($step, 'install');
	}
	
	/**
	 * First step in the installation process. Allows the user to create the database.php file.
	 * Handles only MySQL (tested) and PostgreSQL (not tested).
	 *
	 * @return void
	 */	
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
					$this->__step();
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
					__('Could not connect to the database with the given configuration', true),
					'default', array('class' => 'error')
				);
			}
		} else {
			$this->data['Installer']['host'] = 'localhost';
		}
		$configFileExists = file_exists($this->config_file_location);
		$drivers =	array(
			'mysql' => 'MySQL',
			'postgres' => 'PostgreSQL'
		);
		$this->set(compact('drivers', 'configFileExists'));
	}
	
	/**
	 * Second step in the installation process. Creates loads Ósmosis tables into the database.
	 *
	 * @return void
	 */
	function load_database() {
		$db = ConnectionManager::getDataSource('default');
		if (strpos($db->config['driver'], 'mysql') !== false) {
			$db->execute('ALTER DATABASE ' . $db->startQuote . $db->config['database'] . $db->endQuote . ' CHARACTER SET utf8 COLLATE utf8_unicode_ci');
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
			// @unlink($this->config_file_location);
			$this->Session->setFlash(
				$message,
				'default', array('class' => 'error')
			);
			$this->__step(-1);
		} else {
			$this->__step();
		}
	}

	/**
	 * Third step in the installation process. Creates a new admin user.
	 *
	 * @return void
	 */
	function init_acl() {
		App::import('Component', 'Acl');
		App::import('Component', 'Auth');
		App::import('Component', 'InitAcl');
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
	
	/**
	 * This step asks the information necesary to allow Ósmosis send emails.
	 *
	 * @return void
	 */	
	function configure_mailing() {
		if (!empty($this->data)) {
			if (!$this->data['Installer']['usesmtp']) {
				unset($this->data['Installer']['smtphost']);
				unset($this->data['Installer']['smtplogin']);
				unset($this->data['Installer']['smtppassword']);
			}
			$configurations = array();
			foreach ($this->data['Installer'] as $key => $value) {
				if (trim($value) == '') {
					$configurations = null;
					break;
				}
				$key = 'Mailer.' . $key;
				$configurations[] = compact('key', 'value');
			}
			App::import('Model', 'Setting');
			$this->Setting = new Setting;
			$this->Setting->deleteAll(array('key' => array_keys($configurations)));
			if ($this->Setting->saveAll($configurations)) {
				$this->__step();
			} else {
				$this->Session->setFlash(
					__('Error saving configurations.',true),
					'default', array('class' => 'error')
				);
			}
		} else {
			$this->data['Installer']['name'] = 'Ósmosis LMS';
			$this->data['Installer']['username'] = 'osmosis';
			$this->data['Installer']['domain'] = $_SERVER['HTTP_HOST'];
			$this->data['Installer']['usesmtp'] = false;
		}
	}
	/**
	 * Helper function that writes the database.php file based on some Datasource configuration array.
	 *
	 * @param array $configs Datasource configuration array
	 * @return string database.php file contents
	 */
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
	
	/**
	 * Redirect to next step or to login page on finish.
	 * This way, step order can be changed in valid_steps array.
	 *
	 * @return void
	 */	
	function __step($direction = +1) {
		$next_position = $this->current_step_position + $direction;
		if ($next_position == count($this->valid_steps)) {
			$this->redirect(array('controller' => 'members', 'action' => 'login'));
		}
		$steps = array_keys($this->valid_steps);
		$this->redirect(array('action' => 'index', $steps[$next_position]));
	}
}
?>