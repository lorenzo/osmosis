<div class="textQuestion">
<?php echo $form->create('TextQuestion',array('url'=>array($quizId))); ?>
	<fieldset>
 		<legend><?php echo sprintf(__('Create %s', true), __('Text Question', true));?></legend>
	<?php
		echo $form->input('title');
	?>
	<div class="body">
	<?php
		echo $form->input('Question.body', array('label' => array('text' => __('Something', true), 'class' => 'hidden')));
		echo $form->input('format');
		echo $form->input('tags',array('class' => 'tags'));
	?>
	</div>
	</fieldset>
<?php
	echo $form->input('Quiz.0.id');
	echo $form->end(__('Create Question',true));
?>
</div>
<?php echo $this->element('ui/editor'); ?>