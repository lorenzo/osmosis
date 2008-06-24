<div class="textQuestion">
<?php echo $form->create('TextQuestion',array('url'=>array($quizId))); ?>
	<fieldset>
 		<legend><?php echo sprintf(__('Create %s', true), __('Text Question', true));?></legend>
	<?php
		echo $form->input('title');
		echo $form->input('body', array('label' => __('Something', true)));
		echo $form->input('format');
	?>
	</fieldset>
<?php
	echo $form->input('Quiz.0.id');
	echo $form->end(__('Create Question',true));
?>
</div>
<?php echo $this->element('ui/editor',array('theme' => 'simple')); ?>