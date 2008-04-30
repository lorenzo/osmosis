<div class="responses form">
<?php echo $form->create('Response');?>
	<fieldset>
 		<legend><?php __('Add Response');?></legend>
	<?php
		echo $form->input('discussion_id', array('type' => 'hidden'));
		echo $form->input('member_id', array('type' => 'hidden'));
		echo $form->input('content');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Responses', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Discussions', true), array('controller'=> 'discussions', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Discussion', true), array('controller'=> 'discussions', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Members', true), array('controller'=> 'members', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Member', true), array('controller'=> 'members', 'action'=>'add')); ?> </li>
	</ul>
</div>
