<?php
echo $form->input(
	$type . '.' . $i,
	array(
		'value' => $question_id,
		'type' => 'checkbox',
		'title' => __('Add this question to the Quiz', true),
		'label' => false,
	)
);
?>