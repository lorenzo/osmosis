<?php
class ScormAppController extends AppController {
	var $helpers = array('Javascript');

	function beforeRender() {
		parent::beforeRender();
		if ($this->view=='Media') Configure::write('debug', '0');
	}
}
?>
