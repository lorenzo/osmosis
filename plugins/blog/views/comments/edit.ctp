<div class="comments form">
<?php echo $form->create('Comment');?>
	<fieldset>
 		<legend><?php __d('blog','Edit Comment');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('description');
		echo $form->hidden('post_id');
	?>
	</fieldset>
<?php echo $form->end(__d('blog','Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__d('blog','Delete', true), array('action'=>'delete', $form->value('Comment.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Comment.id'))); ?></li>
		<li><?php echo $html->link(__d('blog','List Comments', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__d('blog','List Posts', true), array('controller'=> 'posts', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__d('blog','New Post', true), array('controller'=> 'posts', 'action'=>'add')); ?> </li>
	</ul>
</div>
