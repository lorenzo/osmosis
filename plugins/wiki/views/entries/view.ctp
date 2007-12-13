<div class="entries view">
	<h1><?php echo $entry['Entry']['title']?></h1>
	<div class="content">
		<?php echo $wiki->format($entry['Entry']['content']); ?>
	</div>
</div>