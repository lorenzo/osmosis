<?php
	$choices = $question['ChoiceChoice'];
?>
<li class="question-list-element">
	<?php
		$num_choices = count($question['ChoiceChoice']);
		$num = __('%s Choices', true);
		if ($num_choices==1) {
			$num = __('%s Choice', true);
		}
		$question = $question['ChoiceQuestion'];
	?>
	<h4><?php echo $html->link($text->truncate($question['body'], 200), array(
			'controller' => 'choice_questions',
			'action' => 'preview',
			$question['id'],
			'course_id' => $course['Course']['id']
			),array('class' => 'question-preview-link'));  ?>
	</h4>
	<?php
		echo $html->tag('span',sprintf($num, $num_choices));
		echo $html->div('question-list-content','');
		echo $this->element(
			'selection_list.add_question',
			array('question_id' => $question['id'], 'i' => $questionIndex, 'type'=>'ChoiceQuestion')
		);
	?>
</li>