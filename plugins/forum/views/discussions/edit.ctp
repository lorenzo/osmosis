<div class="discussions form">
<?php echo $form->create('Discussion');?>
	<fieldset>
 		<legend><?php __('Edit Discussion');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('subject_id');
		echo $form->input('member_id');
		echo $form->input('title');
		echo $form->input('content');
		echo $form->input('locked');
		echo $form->input('status');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Discussion.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Discussion.id'))); ?></li>
		<li><?php echo $html->link(__('List Discussions', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Subjects', true), array('controller'=> 'subjects', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Subject', true), array('controller'=> 'subjects', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Members', true), array('controller'=> 'members', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Member', true), array('controller'=> 'members', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Responses', true), array('controller'=> 'responses', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Response', true), array('controller'=> 'responses', 'action'=>'add')); ?> </li>
	</ul>
</div>
