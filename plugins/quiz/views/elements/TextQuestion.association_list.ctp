<table cellpadding="0" cellspacing="0">
<tr>
	<th>-</th>
	<th><?php echo $paginator->sort('title'); ?></th>
</tr>
<?php
	foreach ($available_questions as $i => $question):
		$question_id = $question['TextQuestion']['id'];
		$checked = in_array($question_id, $quiz_questions);
		$class = null;
		if ($i % 2 == 0) {
			$class = ' class="altrow"';
		}
?>
<tr<?php echo $class;?>>
	<td style="vertical-align:middle;text-align:center;">
		<?php
			echo $form->input('TextQuestion.' . $i, array('type' => 'checkbox', 'value' => $question_id, 'div' => false, 'label' => '', 'checked' => $checked));
		?>
	</td>
	<td>
		<?php
			echo $this->element('TextQuestion.view', array('question' => $question));
		?>
	</td>
</tr>
<?php
	endforeach;
?>
</table>