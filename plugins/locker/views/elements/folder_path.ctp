<ul id="path">
	<li class="home">
		<?php
			echo $html->link(__('home', true),
				array(
					'controller'	=> 'folders',
					'action'		=> 'view',
					'member_id'		=> $member['Member']['id']
				)
			);
		?>
	</li>
<?php
	if (is_array($path)) :
		array_shift($path);
		foreach ($path as $i => $folder) :
?>
	<li>
		<?php
			echo $html->link($folder['name'],
				array(
					'controller'	=> 'folders',
					'action'		=> 'view',
					$folder['parent_id']
				)
			);
		?>
	</li>
<?php
		endforeach;
	endif;
?>
</ul>