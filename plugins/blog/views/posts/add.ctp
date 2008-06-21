<div class="posts form">
<?php echo $form->create('Post');?>
	<fieldset>
 		<legend><?php __('Add Post');?></legend>
	<?php
		echo $form->input('title');
		echo $form->input('body');
		echo $form->hidden('blog_id');
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<?php echo $javascript->link('tiny_mce/tiny_mce',null,null,false); ?>
<?php echo $this->renderElement('ui/editor'); ?>
