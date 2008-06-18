<div id="actions" class="boxed dashboard-element">
	<strong class="title"><?php __('Locker'); ?></strong>
	Aquí deberían ir algunos archivos...
	<?php
		echo $html->link(
			__('your locker', true),
			array(
				'plugin'		=> 'locker',
				'controller'	=> 'folders',
				'action'		=> 'view',
				'member_id'		=> $user['id']
			)
		);
	?>
</div>