<h1><?php __('Welcome'); ?> &mdash; <?php echo $user['full_name']; ?></h1>
<div id="actions" class="boxed dashboard-element">
	<strong class="title"><?php __('Manage'); ?></strong>
	
</div>
<div id="courses" class="boxed dashboard-element">
	<strong class="title"><?php __('Your Courses'); ?></strong>
	
</div>
<?php
	//'cache' => array('time' => '+ 30day', 'key' => $user['id']), 
	echo $this->element('dashboard/profile', compact('user'));
?>