<ul>
	<?php
		$i = 0;
		foreach ($questions as $type => $question) {
			$choices = $question['ChoiceChoice'];
	?>
		<li>
			<?php
				$num_choices = count($question['ChoiceChoice']);
				$num = __('%s Choices', true);
				if ($num_choices==1) {
					$num = __('%s Choice', true);
				}
				$question = $question['ChoiceQuestion'];
			?>
			<strong><?php echo $html->link($text->truncate($question['body'], 200), array(
					'controller' => 'choice_questions',
					'action' => 'view',
					$question['id'],
					'course_id' => $course['Course']['id']
					));  ?>
			</strong><br />
			<?php
			 	echo sprintf($num, $num_choices);
				echo $this->element(
					'selection_list.add_question',
					array('question_id' => $question['id'], 'i' => $i++, 'type'=>'ChoiceQuestion')
				);
			?>
		</li>
	<?php	
		}
	?>
</ul>