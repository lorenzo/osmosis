<li class="blog">
	<?php
		echo $html->link(
			__d('blog','Blog', true),
			array(
				'plugin'		=>'blog',
				'controller'	=> 'blogs',
				'action'		=> 'view',
				'member_id'		=> $data['member_id']
			)
		);
	?>
</li>