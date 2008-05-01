<?php
class ForumAppController extends AppController {
	var $helpers = array('Time', 'Text');
	var $components = array('Security', 'HtmlPurifier');
	var $statuses = null;
	
}
?>
