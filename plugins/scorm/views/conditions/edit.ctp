<div class="condition">
<?php echo $form->create('Condition');?>
	<fieldset>
 		<legend><?php __('Edit');?> <?php __('Condition');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('referencedObjective');
		echo $form->input('measureThreshold');
		echo $form->input('operator');
		echo $form->input('ruleCondition');
		echo $form->input('rule_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Condition.id')), null, __('Are you sure you want to delete', true).' #' . $form->value('Condition.id')); ?></li>
		<li><?php echo $html->link(__('List', true).' '.__('Conditions', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List', true).' '.__('Rules', true), array('controller'=> 'rules', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Rule', true), array('controller'=> 'rules', 'action'=>'add')); ?> </li>
	</ul>
</div>