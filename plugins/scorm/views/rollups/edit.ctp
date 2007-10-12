<div class="rollup">
<?php echo $form->create('Rollup');?>
	<fieldset>
 		<legend><?php __('Edit');?> <?php __('Rollup');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('sco_id');
		echo $form->input('rollupObjectiveSatisfied');
		echo $form->input('rollupProgressCompletion');
		echo $form->input('objectiveMeasureWeight');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Rollup.id')), null, __('Are you sure you want to delete', true).' #' . $form->value('Rollup.id')); ?></li>
		<li><?php echo $html->link(__('List', true).' '.__('Rollups', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List', true).' '.__('Rules', true), array('controller'=> 'rules', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Rule', true), array('controller'=> 'rules', 'action'=>'add')); ?> </li>
	</ul>
</div>