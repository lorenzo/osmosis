<ul>
	<?php
		$i = 0;
		foreach ($questions as $type => $question) {
			$question = $question['TextQuestion'];
	?>
		<li>
			<strong><?php echo $html->link($text->truncate($question['title'], 200), array(
					'controller' => 'text_questions',
					'action' => 'view',
					$question['id'],
					'course_id' => $course['Course']['id']
					)); ?></strong><br />
			<?php
				echo $text->truncate($question['body'], 200);
				echo $this->element('selection_list.add_question', array('question_id' => $question['id'], 'i' => $i++, 'type' => 'TextQuestion'));
			?>
		</li>
	<?php	
		}
	?>
</ul>