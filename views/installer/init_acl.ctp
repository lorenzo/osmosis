<h1><?php __('Installation'); ?></h1>
<h2>
	<?php printf(__('Step', true) . ' %d: %s', $current_step_position, $current_step_name); ?>
</h2>
<p>
	<?php __('Installation is complete, a new administrative user has been created for you: ')?>
</p>
<p class="credentials">
<strong><?php __('Username'); ?>:</strong> <?php echo $member['Member']['username']?><br />
<strong><?php __('Password'); ?>:</strong> <?php echo $member['Member']['password']?>
</p>
<p>
	<?php
		__('That is all. ');
		echo $html->link(__('Log In', true), array('controller' => 'members', 'action' => 'login'));
	?>
</p>