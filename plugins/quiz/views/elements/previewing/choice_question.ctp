<div class="choiceQuestion">
	<?php
		echo $question['ChoiceQuestion']['body'];
	?>
	<ol>
		<?php
			if (isset($question['ChoiceQuestion']['ChoiceChoice']))
				$choices = $question['ChoiceQuestion']['ChoiceChoice'];
			else
				$choices = $question['ChoiceChoice'];
			foreach ($choices as $i => $choice) {
		?>
		<li><?php echo $filter->filter($choice['text']); ?></li>
		<?php
			}
		?>
	</ol>
</div>