<div class="choiceQuestion">
	<?php
		echo $question['ChoiceQuestion']['body'];
	?>
	<ol>
		<?php
			foreach ($question['ChoiceQuestion']['ChoiceChoice'] as $i => $choice) {
		?>
		<li><?php echo $choice['text']; ?></li>
		<?php
			}
		?>
	</ol>
</div>