<?php
echo $form->input(
	'TextQuestion.' . $i,
	array(
		'value' => $question_id,
		'type' => 'checkbox',
		'label' => __('Add this question to the Quiz', true)
	)
);
?>