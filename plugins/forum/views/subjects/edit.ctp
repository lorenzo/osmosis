<div class="subjects form">
<?php echo $form->create('Subject');?>
	<fieldset>
 		<legend><?php __d('forum','Edit Subject');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('title');
		echo $form->input('forum_id');
		echo $form->input('member_id');
		echo $form->input('locked');
		echo $form->input('status');
	?>
	</fieldset>
<?php echo $form->end(__d('forum','Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__d('forum','Delete', true), array('action'=>'delete', $form->value('Subject.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Subject.id'))); ?></li>
		<li><?php echo $html->link(__d('forum','List Subjects', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__d('forum','List Forums', true), array('controller'=> 'forums', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__d('forum','New Forum', true), array('controller'=> 'forums', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__d('forum','List Members', true), array('controller'=> 'members', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__d('forum','New Member', true), array('controller'=> 'members', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__d('forum','List Discussions', true), array('controller'=> 'discussions', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__d('forum','New Discussion', true), array('controller'=> 'discussions', 'action'=>'add')); ?> </li>
	</ul>
</div>
