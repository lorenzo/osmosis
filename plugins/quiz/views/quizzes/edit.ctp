<h1><?php echo sprintf(__('Edit %s %s', true), __('Quiz', true), $form->value('name'));?></h1>
<div class="question-list">
	<?php echo __('Question type:', true); ?>
	<?php
		echo $form->create('Quiz', array('action' => 'add_question'));
		echo $this->renderElement('question_drop_list', array('quiz_id' => $this->data['Quiz']['id']));
	?>
	<div id="questions">
		<div class="list">
			<?php
				foreach ($question_list as $type => $questions) {
					if ($type != 'TextQuestion') continue;
					echo $this->renderElement($type . '_selection_list', array('questions' => $questions));
				}
			?>
		</div>
	</div>
	<?php
		echo $form->submit(__('Associate', true));
		echo $form->end();
	?>
</div>
<div class="quiz-preview">
	<div class="content">
		<h2>&mdash; <?php echo $this->data['Quiz']['name'] ?> &mdash;</h2>
		<?php
			unset($this->data['Quiz']);
			foreach ($this->data as $type => $question_list) {
				if (empty($question_list)) continue;
				echo '<h3>' . __($type, true) . '</h3>';
				echo '<ol>';
				foreach ($question_list as $i => $question) {
					$question = array($type => $question);
					echo '<li>' . $this->renderElement($type . '_view', array('question' => $question)) . '</li>';
				}
				echo '</ol>';
			}
		?>
	</div>
</div>