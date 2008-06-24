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
			<strong><?php echo $text->truncate($question['body'], 200) ?></strong><br />
			<?php
			 	echo sprintf($num, $num_choices) . ' | ';
				echo $html->link(__('view', true), array('controller' => 'choice_questions', 'action' => 'view', $question['id']));
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