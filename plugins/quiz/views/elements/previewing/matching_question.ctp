<div class="matchingQuestion view">
	<?php echo $html->div('matching-question-body',$question['MatchingQuestion']['body']) ?>
	<div class="choice question set">
		<ol>
	<?php
		if (isset($question['MatchingQuestion']['SourceChoice']))
			$sources = $question['MatchingQuestion']['SourceChoice'];
		else
			$sources = $question['SourceChoice'];
		foreach ($sources as $key => $value) {
			echo '<li>'.$filter->filter($value['text']).'</li>';
		}
	?>
		</ol>
	</div>
	<div class="choice answer set">
		<ol>
	<?php
		if (isset($question['MatchingQuestion']['TargetChoice']))
			$targets = $question['MatchingQuestion']['TargetChoice'];
		else
			$targets = $question['TargetChoice'];
		foreach ($targets as $key => $value) {
			echo '<li>'.$filter->filter($value['text']).'</li>';
		}
	?>
		</ol>
	</div>
	<br style="clear:both" />
</div>