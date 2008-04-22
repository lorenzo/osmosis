<?php
class PluginsController extends AppController {

	var $name = 'Plugins';
	var $helpers = array('Html', 'Form');

	
	function admin_index() {
		$this->Plugin->recursive = 0;
		$this->set('plugins', $this->Plugin->find('all'));
		$this->set('inServer',$this->Plugin->inServer());
	}
	
	function admin_install($plugin) {
		$inServer = $this->Plugin->inServer();
		if (!$plugin || !array_key_exists(Inflector::camelize($plugin),$inServer)) {
			$this->Session->setFlash(__('Invalid Plugin.', true));
		}
		//TODO: Check if the plugin has it's own installation method
		if(	$this->Plugin->install(Inflector::camelize($plugin))) {
			$this->Session->setFlash(__('Plugin Instaled.', true));
		}else {
			$this->Session->setFlash(__('An error ocurred while intalling the plugin. Try again', true));
		}
		$this->redirect(array('action'=>'index'));
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Plugin.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('plugin', $this->Plugin->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Plugin->create();
			if ($this->Plugin->save($this->data)) {
				$this->Session->setFlash(__('The Plugin has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Plugin could not be saved. Please, try again.', true));
			}
		}
		$availables = $this->Plugin->installable();
		$this->set(compact('availables'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Plugin', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Plugin->save($this->data)) {
				$this->Session->setFlash(__('The Plugin has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Plugin could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Plugin->read(null, $id);
		}
		$courses = $this->Plugin->Course->find('list');
		$this->set(compact('courses'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Plugin', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Plugin->del($id)) {
			$this->Session->setFlash(__('Plugin deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>