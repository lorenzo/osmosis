<div class="posts form">
<?php echo $form->create('Post');?>
	<fieldset>
 		<legend><?php __('Add Post');?></legend>
	<?php
		echo $form->input('title', array('size' => 60));
		echo $form->input('body', array('label' => array('class' => 'hidden')));
		echo $form->hidden('blog_id');
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<?php echo $this->element('ui/editor'); ?>