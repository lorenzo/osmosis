<ul>
	<?php
		$i = 0;
		foreach ($questions as $type => $question) {
	?>
		<li>
			<?php
				$num_choices = sizeof($question['OrderingChoice']);
				$num = __('%s Choices', true);
				if ($num_choices==1) {
					$num = __('%s Choice', true);
				}
				$question = $question['OrderingQuestion'];
			?>
			<strong><?php echo $html->link($text->truncate($question['body'], 200), array(
					'controller' => 'ordering_questions',
					'action' => 'view',
					$question['id'],
					'course_id' => $course['Course']['id']
					)); ?>
			</strong><br />
			<?php
			 	echo sprintf($num, $num_choices);
				echo $this->element(
					'selection_list.add_question',
					array('question_id' => $question['id'], 'i' => $i++, 'type'=>'OrderingQuestion')
				);
			?>
		</li>
	<?php	
		}
	?>
</ul>