<div class="rollup">
<?php echo $form->create('Rollup');?>
	<fieldset>
 		<legend><?php __('Add');?> <?php __('Rollup');?></legend>
	<?php
		echo $form->input('sco_id');
		echo $form->input('rollupObjectiveSatisfied');
		echo $form->input('rollupProgressCompletion');
		echo $form->input('objectiveMeasureWeight');
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List', true).' '.__('Rollups', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List', true).' '.__('Rules', true), array('controller'=> 'rules', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Rule', true), array('controller'=> 'rules', 'action'=>'add')); ?> </li>
	</ul>
</div>