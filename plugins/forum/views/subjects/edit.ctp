<div class="subjects form">
<?php echo $form->create('Subject');?>
	<fieldset>
 		<legend><?php __('Edit Subject');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('title');
		echo $form->input('forum_id');
		echo $form->input('member_id');
		echo $form->input('locked');
		echo $form->input('status');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Subject.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Subject.id'))); ?></li>
		<li><?php echo $html->link(__('List Subjects', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Forums', true), array('controller'=> 'forums', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Forum', true), array('controller'=> 'forums', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Members', true), array('controller'=> 'members', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Member', true), array('controller'=> 'members', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Discussions', true), array('controller'=> 'discussions', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Discussion', true), array('controller'=> 'discussions', 'action'=>'add')); ?> </li>
	</ul>
</div>
