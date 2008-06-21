<div class="deliveryControl">
<?php echo $form->create('DeliveryControl');?>
	<fieldset>
 		<legend><?php __('Edit');?> <?php __('DeliveryControl');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('sco_id');
		echo $form->input('tracked');
		echo $form->input('completionSetByContent');
		echo $form->input('objectiveSetByContent');
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('DeliveryControl.id')), null, __('Are you sure you want to delete', true).' #' . $form->value('DeliveryControl.id')); ?></li>
		<li><?php echo $html->link(__('List', true).' '.__('DeliveryControls', true), array('action'=>'index'));?></li>
	</ul>
</div>