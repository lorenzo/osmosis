<div class="posts form">
<?php echo $form->create('Post');?>
	<fieldset>
 		<legend><?php __('Add Post');?></legend>
	<?php
		echo $form->input('title');
		echo $form->input('body');
		echo $form->input('blog_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Posts', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Blogs', true), array('controller'=> 'blogs', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Blog', true), array('controller'=> 'blogs', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Comments', true), array('controller'=> 'comments', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Comment', true), array('controller'=> 'comments', 'action'=>'add')); ?> </li>
	</ul>
</div>
