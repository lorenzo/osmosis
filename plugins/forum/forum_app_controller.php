<?php
class ForumAppController extends AppController {
	var $helpers = array('Time', 'Text');
	var $components = array('Security', 'HtmlPurifier');
	
	function _setActiveCourse() {
		if (isset($this->params['named']['course_id'])) {
			parent::_setActiveCourse();
			return true;
		}
		return false;
	}
	
}
?>
