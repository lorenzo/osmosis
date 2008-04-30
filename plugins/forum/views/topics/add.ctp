<div class="topics form">
<?php echo $form->create('Topic');?>
	<fieldset>
 		<legend><?php __('Create Topic');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('description', array('type' => 'textarea'));
		echo $form->input('forum_id', array('type' => 'hidden'));
	?>
	</fieldset>
<?php echo $form->end(__('Create Topic', true));?>
</div>