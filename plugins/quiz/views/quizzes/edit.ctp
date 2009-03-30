<h1><?php echo sprintf(__('Edit %s %s', true), __('Quiz', true), $this->data['Quiz']['name']);?></h1>
<div class="question-list">
	<?php
		echo $form->create('Quiz', array('action' => 'add_question'));
		echo $this->element('question_drop_list', array('quiz_id' => $this->data['Quiz']['id']));
	?>
	<div id="questions">
		<div class="list">
			<?php
				$haveQuestions = false;
				foreach ($question_list as $type => $questions) {
					if (empty($questions)) {
						$link = '';
						$message = __('There are no questions of this type available', true);
						if ($question_type!='all') {
							$link = '<br />' . $html->link(
								__('create one', true),
								array(
									'controller'=>Inflector::pluralize($question_type),
									'action' => 'add',
									'quiz' => $this->data['Quiz']['id']
								)
							);
						} else {
							$message = __('There are no questions available', true);
						}
						continue;
					}
					$haveQuestions = true;
					echo $this->element('listing/'.Inflector::underscore($type), array('questions' => $questions));
				}
				
				if (!$haveQuestions)
					printf('<p class="empty">%s%s</p>', $message, $link);
			?>
		</div>
	</div>
	<?php
		echo $form->submit(__('Add to quiz', true));
		echo $form->end();
	?>
</div>
<div class="quiz-preview">
	<div class="content">
		<h2>&mdash; <?php echo $this->data['Quiz']['name'] ?> &mdash;</h2>
		<?php
			unset($this->data['Quiz']);
			echo '<ol>';
			foreach ($this->data['Question'] as $index => $question) {
				echo '<h3>' . __(Inflector::humanize(Inflector::underscore($question['type'])), true) . '</h3>';
				echo '<li>' . $this->element('previewing/'.Inflector::underscore($question['type']), array('question' => $question)) . '&nbsp;</li>';
			}
			echo '</ol>';
		?>
	</div>
</div>