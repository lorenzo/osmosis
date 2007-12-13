<div class="orderingChoice">
<?php echo $form->create('OrderingChoice');?>
	<fieldset>
 		<legend><?php echo sprintf(__('Edit %s', true), __('OrderingChoice', true));?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('ordering_question_id');
		echo $form->input('text');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('OrderingChoice.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('OrderingChoice.id'))); ?></li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('OrderingChoices', true)), array('action'=>'index'));?></li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Ordering Questions', true)), array('controller'=> 'ordering_questions', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('Ordering Question', true)), array('controller'=> 'ordering_questions', 'action'=>'add')); ?> </li>
	</ul>
</div>
