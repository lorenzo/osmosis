<div id="actions" class="boxed dashboard-element">
	<strong class="title"><?php __('Blog Comments'); ?></strong>
	Acá deberían aparecer los mensajes en tu blog.
	<?php
		echo $html->link(
			'your blog',
			array(
				'controller' => 'blogs',
				'action'	=> 'view',
				'plugin'	=> 'blog',
				'member_id' => $Osmosis['active_member']['id']
			)
		);
	?>
</div>