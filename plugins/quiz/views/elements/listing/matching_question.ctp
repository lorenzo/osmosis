<ul>
	<?php
		$i = 0;
		foreach ($questions as $type => $question) {
			$num_choices = sizeof($question['SourceChoice']);
			$question = $question['MatchingQuestion'];
	?>
		<li>
			<?php
				$num = __('%s Match items', true);
				if ($num_choices==1) {
					$num = __('%s Match item', true);
				}
			?>
			<strong><?php echo $html->link($text->truncate($question['body'], 200), array(
					'controller' => 'matching_questions',
					'action' => 'view',
					$question['id'],
					'course_id' => $course['Course']['id']
					)); ?>
			</strong><br />
			<?php
			 	echo sprintf($num, $num_choices);
				echo $this->element(
					'selection_list.add_question',
					array('question_id' => $question['id'], 'i' => $i++, 'type'=>'MatchingQuestion')
				);
			?>
		</li>
	<?php	
		}
	?>
</ul>