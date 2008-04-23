<div class="orderingQuestion">
	<?php echo $question['OrderingQuestion']['body'] ?>
	<ol>
	<?php
		foreach ($question['OrderingQuestion']['OrderingChoice'] as $i => $choice) {
	?>
		<li><?php echo $choice['text']?></li>
	<?php
		}
	?>
	</ol>
</div>