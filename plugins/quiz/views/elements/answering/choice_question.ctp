<?php
	$type = 'radio';
	$legend = false;
	$label = false;
	$empty = true;
	if ($question['ChoiceQuestion']['max_choices'] > 1) {
		$type = 'select';
		$multiple = 'checkbox';
		$empty = false;
	}
		
	$options = Set::combine($question['ChoiceChoice'],'{n}.id','{n}.text');
?>
<div class="question choiceQuestion">
	<?php
		echo $question['ChoiceQuestion']['body'];
		echo $form->input('ChoiceQuestion.'.$question['ChoiceQuestion']['id'],compact('type','multiple','label','empty','options','legend'));
	?>
</div>