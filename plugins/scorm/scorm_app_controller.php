<?php
class ScormAppController extends Controller{

	function beforeRender() {
		parent::beforeRender();
		if ($this->view=='Media') Configure::write('debug', '0');
	}
}
?>
