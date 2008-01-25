<div class="entries view">
	<h1>
		<?php echo $entry['Entry']['title']?>
		<span class="note">&mdash; <?php echo $html->link(__('edit', true), array('action' => 'edit', $entry['Entry']['id']))?></span>
	</h1>
	<div class="wiki-content">
		<?php echo $wiki->format($entry['Entry']['content']); ?>
	</div>
</div>