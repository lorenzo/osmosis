<?php
class DeliveryControlsController extends ScormAppController {

	var $name = 'DeliveryControls';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->DeliveryControl->recursive = 0;
		$this->set('deliveryControls', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid Delivery Control.');
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('deliveryControl', $this->DeliveryControl->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->DeliveryControl->create();
			if ($this->DeliveryControl->save($this->data)) {
				$this->Session->setFlash('The Delivery Control has been saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Delivery Control could not be saved. Please, try again.');
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Delivery Control');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->DeliveryControl->save($this->data)) {
				$this->Session->setFlash('The Delivery Control saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Delivery Control could not be saved. Please, try again.');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->DeliveryControl->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Delivery Control');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->DeliveryControl->del($id)) {
			$this->Session->setFlash('Delivery Control #'.$id.' deleted');
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

}
?>
