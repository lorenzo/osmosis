<ul id="path">
<?php
	if (is_array($path)) :
		foreach ($path as $i => $folder) :
			$class = '';
			if ($folder['name'] == 'locker' && $folder['parent_id']==null) {
				$class = ' class="home"';
			}
?>
	<li<?php echo $class; ?>>
		<?php
			if (($i != count($path) - 1 || count($path) == 1) || isset($document)) {
				echo $html->link($folder['name'],
					array(
						'controller'	=> 'folders',
						'action'		=> 'view',
						$folder['id']
					), array('class' => 'item', 'rev' => $folder['id'])
				);
			} else {
				echo '<span>' . $folder['name'] . '</span>';
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