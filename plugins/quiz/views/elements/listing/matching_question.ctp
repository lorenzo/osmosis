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
			<strong><?php echo $text->truncate($question['body'], 200) ?></strong><br />
			<?php
			 	echo sprintf($num, $num_choices) . ' | ';
				echo $html->link(__('view', true), array('controller' => 'choice_questions', 'action' => 'view', $question['id']));
				echo $this->renderElement(
					'selection_list.add_question',
					array('question_id' => $question['id'], 'i' => $i++, 'type'=>'MatchingQuestion')
				);
			?>
		</li>
	<?php	
		}
	?>
</ul>