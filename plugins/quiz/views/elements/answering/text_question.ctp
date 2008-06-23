<div class="question textQuestion">
	<strong><?php echo $question['TextQuestion']['title'] ?></strong>
	<span class="question-body">
		<?php echo $question['TextQuestion']['body']; ?>
	</span>
	<?php echo $form->input('TextQuestion.'.$question['TextQuestion']['id'].'.answer', array('type' =>'textarea')); ?>
</div>