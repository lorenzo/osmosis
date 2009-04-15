<div class="question textQuestion">
	<strong><?php echo $question['TextQuestion']['title'] ?></strong>
	<span class="question-body">
		<?php echo $filter->filter($question['TextQuestion']['body']); ?>
	</span>
	<?php echo $form->input('TextQuestion.'.$question['TextQuestion']['id'].'.answer', array('type' =>'textarea','label' => false)); ?>
</div>
