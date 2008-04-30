<?php
class ForumAppController extends AppController {
	var $helpers = array('Time');
	var $statuses = null;
	
	function beforeRender() {
		parent::beforeRender();
		$this->statuses = array(
			'open' => __('Open', true),
			'closed' => __('Closed', true)
		);
		$this->set('statuses', $this->statuses);
	}
}
?>
