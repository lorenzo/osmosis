<?php ?>
<div class="comments form">
<?php echo $form->create('Comment');?>
	<fieldset>
 		<legend><?php __d('blog','Add Comment');?></legend>
	<?php
		echo $form->input('description');
		echo $form->hidden('post_id');
		echo $form->input('member_id');
	?>
	</fieldset>
<?php echo $form->end(__d('blog','Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__d('blog','List Comments', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__d('blog','List Posts', true), array('controller'=> 'posts', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__d('blog','New Post', true), array('controller'=> 'posts', 'action'=>'add')); ?> </li>
	</ul>
</div>

