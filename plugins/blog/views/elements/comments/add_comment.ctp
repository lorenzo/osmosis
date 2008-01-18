<div class="comments form">
<?php echo $form->create('Comment');?>
	<fieldset>
 		<legend><?php __('Add Comment');?></legend>
	<?php
		echo $form->input('comment');
		echo $form->hidden('post_id', array('value'=>$post_id));
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>


