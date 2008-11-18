<div class="blogs form">
<?php echo $form->create('Blog');?>
	<fieldset>
 		<legend><?php __d('blog','Edit Blog');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('title');
		echo $form->input('description');
		echo $form->input('owner');
	?>
	</fieldset>
<?php echo $form->end(__d('blog','Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__d('blog','Delete', true), array('action'=>'delete', $form->value('Blog.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Blog.id'))); ?></li>
		<li><?php echo $html->link(__d('blog','List Blogs', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__d('blog','List Posts', true), array('controller'=> 'blogs', 'action'=>'view', $form->value('Blog.id'))); ?> </li>
		<li><?php echo $html->link(__d('blog','New Post', true), array('controller'=> 'posts', 'action'=>'add', $form->value('Blog.id'))); ?> </li>
	</ul>
</div>
