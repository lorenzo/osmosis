<div class="orderingQuestion">
	<?php echo $question['OrderingQuestion']['body'] ?>
	<ol>
	<?php
		if (isset($question['OrderingQuestion']['OrderingChoice']))
			$choices = $question['OrderingQuestion']['OrderingChoice'];
		else
			$choices = $question['OrderingChoice'];
		foreach ($choices as $i => $choice) {
	?>
		<li><?php echo $filter->filter($choice['text']) ?></li>
	<?php
		}
	?>
	</ol>
</div>