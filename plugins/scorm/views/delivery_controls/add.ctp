<div class="deliveryControl">
<?php echo $form->create('DeliveryControl');?>
	<fieldset>
 		<legend><?php __('Add');?> <?php __('DeliveryControl');?></legend>
	<?php
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
		<li><?php echo $html->link(__('List', true).' '.__('DeliveryControls', true), array('action'=>'index'));?></li>
	</ul>
</div>