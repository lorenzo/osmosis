<div class="content-title">
	<h2><?php echo $entry['title']?></h2>
	<ul class="reverse actions">
		<li class="edit">
			<?php
				echo $html->link(
					__('edit this entry', true),
					array(
						'controller'	=> 'entries',
						'action'		=> 'edit', 
						$entry['id'],
						'wiki_id' 		=> $entry['wiki_id']
					)
				);
			?>
		</li>
		<?php
			if ($entry['revision']>1) :
		?>
		<li class="info">
			<?php
				echo $html->link(
					__('view history', true),
					array(
						'controller'	=> 'revisions',
						'action'		=> 'history', 
						$entry['id'],
						'wiki_id' 		=> $entry['wiki_id']
					)
				);
			?>
		</li>
		<?php
			endif;
		?>
	</ul>
</div>
<div class="entry-content">
	<?php echo $wiki->format($filter->filter($entry['content'])); ?>
</div>