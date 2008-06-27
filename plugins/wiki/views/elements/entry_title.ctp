<div class="entry-title">
	<h2><?php echo $entry['title']?></h2>
	<ul class="actions">
		<li class="edit">
			<?php
				echo $html->link(
					__('edit', true),
					array(
						'action' => 'edit', 
						$entry['id'],
						'wiki_id' =>$entry['wiki_id']
					)
				);
			?>
		</li>
	</ul>
</div>