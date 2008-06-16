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
			$this->Session->setFlash(__('An error occurred while setting plugin permissions',true));
		} elseif (!$this->Installer->createSchema('Blog')) {
			$this->Session->setFlash(__('An error occurred while installing the plugin',true));
		} elseif ($this->Plugin->install('Blog'))
			$this->Session->setFlash(__('Plugin Blog installed',true));
			
		
		$this->redirect(array('plugin'=>'','admin' => true,'controller' => 'plugins'));
	}
}
?>
