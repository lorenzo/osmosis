<ul id="path">
	<li class="home">
		<?php
			echo $html->link(__('home', true),
				array(
					'controller'	=> 'folders',
					'action'		=> 'view',
					'member_id'		=> $member['id']
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
			if ($i != count($path) - 1 || isset($document)) {
				echo $html->link($folder['name'],
					array(
						'controller'	=> 'folders',
						'action'		=> 'view',
						$folder['id']
					)
				);
			} else {
				echo $folder['name'];
			}
		?>
	</li>
<?php
		endforeach;
	endif;
	if (isset($document)) :
?>
	<li><?php echo $document['name']; ?></li>
<?php
	endif;
?>	
</ul>