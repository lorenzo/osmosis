<?php
	$question = $question['TextQuestion'];
?>
<li class="question-list-element">
	<h4><?php echo $html->link($text->truncate($question['title'], 200), array(
					'controller' => 'text_questions',
					'action' => 'preview',
					$question['id'],
					'course_id' => $course['Course']['id']
				),array(
					'class' => 'question-preview-link'
				)
			); ?>
	</h4>
	<?php
		echo $html->div('question-list-content','');
		echo $this->element('selection_list.add_question', array('question_id' => $question['id'], 'i' => $questionIndex, 'type' => 'TextQuestion'));
	?>
</li>