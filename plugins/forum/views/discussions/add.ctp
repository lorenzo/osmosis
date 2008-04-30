<div class="discussions form">
<?php echo $form->create('Discussion');?>
	<fieldset>
 		<legend><?php __('New Discussion');?></legend>
	<?php
		echo $form->input('topic_id', array('type' => 'hidden'));
		echo $form->input('title');
		echo $form->input('content');
	?>
	<div class="checkbox">
		<?php echo $form->input('sticky', array('label' => __('Keep this discussion on top', true))); ?>
	</div>
	<?php
		// echo $form->input('status');
	?>
	</fieldset>
<?php echo $form->end(__('Create Discussion', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Discussions', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Topics', true), array('controller'=> 'topics', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Topic', true), array('controller'=> 'topics', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Members', true), array('controller'=> 'members', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Member', true), array('controller'=> 'members', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Responses', true), array('controller'=> 'responses', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Response', true), array('controller'=> 'responses', 'action'=>'add')); ?> </li>
	</ul>
</div>
