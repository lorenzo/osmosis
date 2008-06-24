<div class="comments form">
<?php echo $form->create('Comment');?>
	<fieldset>
 		<legend><?php __('Leave a Comment');?></legend>
	<?php
		echo $form->input('comment', array('label' => array('class' => 'hidden')));
		echo $form->hidden('post_id', array('value'=>$post_id));
	?>
	</fieldset>
<?php echo $form->end(__('Comment', true));?>
</div>


