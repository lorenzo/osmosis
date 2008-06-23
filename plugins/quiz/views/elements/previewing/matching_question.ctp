<div class="matchingQuestion view">
	<?php echo $question['MatchingQuestion']['body'] ?>
	<div class="choice question set">
		<ol>
	<?php
		foreach ($question['MatchingQuestion']['SourceChoice'] as $key => $value) {
			echo '<li>'.$filter->filter($value['text']).'</li>';
		}
	?>
		</ol>
	</div>
	<div class="choice answer set">
		<ol>
	<?php
		foreach ($question['MatchingQuestion']['TargetChoice'] as $key => $value) {
			echo '<li>'.$filter->filter($value['text']).'</li>';
		}
	?>
		</ol>
	</div>
</div>