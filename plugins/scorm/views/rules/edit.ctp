<div class="rule">
<?php echo $form->create('Rule');?>
	<fieldset>
 		<legend><?php __('Edit');?> <?php __('Rule');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('sco_id');
		echo $form->input('type');
		echo $form->input('conditionCombination');
		echo $form->input('action');
		echo $form->input('minimumPercent');
		echo $form->input('minimumCount');
		echo $form->input('rollup_id');
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Rule.id')), null, __('Are you sure you want to delete', true).' #' . $form->value('Rule.id')); ?></li>
		<li><?php echo $html->link(__('List', true).' '.__('Rules', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List', true).' '.__('Conditions', true), array('controller'=> 'conditions', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Condition', true), array('controller'=> 'conditions', 'action'=>'add')); ?> </li>
	</ul>
</div>