<div class="comments form">
<?php echo $form->create('Comment');?>
	<fieldset>
 		<legend><?php __d('blog','Leave a Comment');?></legend>
	<?php
		echo $form->input('comment', array('label' => array('class' => 'hidden')));
		echo $form->hidden('post_id', array('value'=>$post_id));
	?>
	</fieldset>
<?php echo $form->end(__d('blog','Comment', true));?>
</div>


