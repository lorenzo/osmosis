<div class="matchingQuestion view answering">
	<?php echo $question['MatchingQuestion']['body'] ?>
	<div class="choice question set">
		<ol>
	<?php
		foreach ($question['MatchingQuestion']['SourceChoice'] as $key => $value) {
			echo '<li>'.$filter->filter($value['text'])
			.$form->input('MatchingQuestion.'.$question['MatchingQuestion']['id'].'.answer.'.$value['id'],array('label' => false))
			.'</li>';
		}
	?>
		</ol>
	</div>
	<div class="choice answer set">
		<ol>
	<?php
		foreach ($question['MatchingQuestion']['TargetChoice'] as $key => $value) {
			echo '<li>'.$filter->filter($value['text']).'</li>';
			echo $form->input('MatchingQuestion.'.$question['MatchingQuestion']['id'].'.TargetChoice.'.($key + 1),array('type' => 'hidden','value' =>$value['id']));
		}
	?>
		</ol>
	</div>
</div>
<br style="clear:both" />