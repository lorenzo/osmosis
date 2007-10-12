<div class="randomization">
<?php echo $form->create('Randomization');?>
	<fieldset>
 		<legend><?php __('Edit');?> <?php __('Randomization');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('sco_id');
		echo $form->input('randomizationTiming');
		echo $form->input('selectCount');
		echo $form->input('reorderChildren');
		echo $form->input('selectionTiming');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Randomization.id')), null, __('Are you sure you want to delete', true).' #' . $form->value('Randomization.id')); ?></li>
		<li><?php echo $html->link(__('List', true).' '.__('Randomizations', true), array('action'=>'index'));?></li>
	</ul>
</div>