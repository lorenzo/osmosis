<li class="blog">
	<?php
		echo $html->link(
			__('Blog', true),
			array(
				'plugin'		=>'blog',
				'controller'	=> 'blogs',
				'action'		=> 'view',
				'member_id'		=> $data['member_id']
			)
		);
	?>
</li>