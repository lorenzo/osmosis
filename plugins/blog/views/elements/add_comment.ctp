<div class="comments form">
<?php echo $form->create('Comment');?>
	<fieldset>
 		<legend><?php __('Add Comment');?></legend>
	<?php
		echo $form->input('description');
		echo $form->hidden('post_id', array('value'=> $post_id));
		echo $form->input('member_id');
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>