<div class="topics form">
<?php echo $form->create('Topic');?>
	<fieldset>
 		<legend><?php __('Add Topic');?></legend>
	<?php
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
		<li><?php echo $html->link(__('List Topics', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Forums', true), array('controller'=> 'forums', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Forum', true), array('controller'=> 'forums', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Members', true), array('controller'=> 'members', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Member', true), array('controller'=> 'members', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Discussions', true), array('controller'=> 'discussions', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Discussion', true), array('controller'=> 'discussions', 'action'=>'add')); ?> </li>
	</ul>
</div>
