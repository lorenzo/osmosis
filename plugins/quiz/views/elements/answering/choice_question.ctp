<?php
	$type = 'select';
	$label = false;
	$empty = true;
	if ($question['ChoiceQuestion']['max_choices'] > 1) {
		$multiple = 'checkbox';
		$empty = false;
	}
		
	$options = Set::combine($question['ChoiceQuestion']['ChoiceChoice'],'{n}.id','{n}.text');
?>
<div class="question choiceQuestion">
	<?php
		echo $question['ChoiceQuestion']['body'];
		echo $form->input('ChoiceQuestion.'.$question['ChoiceQuestion']['id'].'.answer',compact('type','multiple','label','empty','options'));
	?>
</div>