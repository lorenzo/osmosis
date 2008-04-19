<ul>
	<?php
		$i = 0;
		foreach ($questions as $type => $question) {
			$question = $question['TextQuestion'];
	?>
		<li>
			<?php
				echo $html->link($question['title'], array('controller' => 'text_questions', 'action' => 'view', $question['id']));
				echo $form->input(
					'TextQuestion.' . $i++,
					array(
						'value' => $question['id'],
						'type' => 'checkbox',
						'label' => __('Add this question to the Quiz', true)
					)
				);
			?>
		</li>
	<?php	
		}
	?>
</ul>