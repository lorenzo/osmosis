<div class="posts form">
<?php echo $form->create('Post');?>
	<fieldset>
 		<legend><?php __('Edit Post');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('title');
		echo $form->input('body');
		echo $form->hidden('blog_id');
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<?php echo $javascript->link('tiny_mce/tiny_mce',null,null,false); ?>
<?php echo $this->renderElement('ui/editor'); ?>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Post.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Post.id'))); ?></li>
		<li><?php echo $html->link(__('List Posts', true), array('action'=>'view', 'controller'=> 'Blogs', $this->data['Post']['blog_id']));?></li>
		<li><?php echo $html->link(__('List Comments', true), array('controller'=> 'posts', 'action'=>'view', $this->data['Post']['slug'])); ?> </li>
		<li><?php echo $html->link(__('New Comment', true), array('controller'=> 'posts', 'action'=>'view', $this->data['Post']['slug'])); ?> </li>
	</ul>
</div>
