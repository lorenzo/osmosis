<div class="topics form">
<?php echo $form->create('Topic');?>
	<fieldset>
 		<legend><?php __d('forum','Create Topic');?></legend>
	<?php
		echo $form->input('name', array('size' => '30'));
		echo $form->input('description', array('size' => '60'));
		echo $form->input('course_id', array('type' => 'hidden'));
	?>
	</fieldset>
<?php echo $form->end(__d('forum','Create Topic', true));?>
</div>