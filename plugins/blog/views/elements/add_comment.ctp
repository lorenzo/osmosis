<div class="comments form">
<?php echo $form->create('Comment');?>
	<fieldset>
 		<legend><?php __d('blog','Add Comment');?></legend>
	<?php
		echo $form->input('description');
		echo $form->hidden('post_id', array('value'=> $post_id));
		echo $form->input('member_id');
	?>
	</fieldset>
<?php echo $form->end(__d('blog','Submit', true));?>
</div>