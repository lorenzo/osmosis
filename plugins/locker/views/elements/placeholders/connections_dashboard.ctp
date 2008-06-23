<div id="actions" class="boxed dashboard-element">
	<strong class="title"><?php __('Locker'); ?></strong>
	<?php
		debug($data);
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