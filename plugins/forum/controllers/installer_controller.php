<?php
class InstallerController extends AppController {

	var $name = 'Installer';
	var $helpers = array('Html', 'Form');
	var $uses = array('Plugin');
	var $components = array('Installer','InitAcl');

	/**
	 * Load plugin tables in the database and installs the plugin in the database.
	 *
	 * @return void
	 */
	
	function admin_install() {
		if (!$this->InitAcl->loadPermissions()) {
			$this->Session->setFlash(__('An error occurred while setting plugin permissions',true), 'default', array('class' => 'error'));
		} elseif (!$this->Installer->createSchema('Forum')) {
			$this->Session->setFlash(__('An error occurred while installing the plugin',true), 'default', array('class' => 'error'));
		} elseif ($this->Plugin->install('Forum'))
			$this->Session->setFlash(__('Plugin Forum installed',true), 'default', array('class' => 'success'));
			
		
		$this->redirect(array('plugin'=>'','admin' => true,'controller' => 'plugins'));
	}
}
?>
