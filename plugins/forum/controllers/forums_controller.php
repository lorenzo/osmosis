<?php
class ForumsController extends AppController {

	var $name = 'Forums';
	var $helpers = array('Html');
	var $scaffold;
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Forum.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('forum', $this->Forum->read(null, $id));
	}
}
?>
