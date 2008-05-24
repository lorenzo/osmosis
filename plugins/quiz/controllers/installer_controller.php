<?php
class InstallerController extends AppController {

	var $name = 'Installer';
	var $helpers = array('Html', 'Form');
	var $uses = array('Plugin');
	var $components = array('Installer');

	/**
	 * Load plugin tables in the database and installs the plugin in the database.
	 *
	 * @return void
	 */
	
	function admin_install() {
		if (!$this->Installer->createSchema('Quiz')) {
			$this->Session->setFlash(__('An error occurred while installing the plugin',true));
		} elseif ($this->Plugin->install('Quiz'))
			$this->Session->setFlash(__('Plugin Quiz installed',true));
			
		$this->redirect(array('plugin'=>'','admin' => true,'controller' => 'plugins'));
	}
}
?>
