<div class="matchingQuestion">
	<?php echo $question['MatchingQuestion']['body'] ?>
	<div class="choice question set">
	<?php
		foreach ($question['MatchingQuestion']['SourceChoice'] as $key => $value) {
			echo "some question";
		}
	?>
	</div>
	<div class="choice answer set">
	<?php
		foreach ($question['MatchingQuestion']['TargetChoice'] as $key => $value) {
			echo "some answer";
		}
	?>
	</div>
</div>