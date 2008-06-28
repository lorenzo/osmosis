<div class="quiz">
<?php echo $form->create('Quiz',array('url' => array('course_id' => $course_id)));?>
	<fieldset>
 		<legend><?php echo sprintf(__('Add %s', true), __('Quiz', true));?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('course_id',array('type' => 'hidden','value' => $course_id));
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>