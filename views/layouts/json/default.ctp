{
	<?php
		if ($session->check('Message.flash')) {
			echo 'flash : ' . $javascript->object($session->read('Message.flash')) . ',';
			$session->del('Message.flash');
		}
		
	?> 
	<?php
		if (!empty($this->validationErrors)) {
			echo 'errors : ' . $javascript->object($this->validationErrors) . ',';
		}
	?> 
	<?php
		if (isset($redirect)) {
			echo 'redirect : "' . $html->url($redirect) . '",';
		}
	?> 
	response :
<?php echo $content_for_layout; ?> 

}