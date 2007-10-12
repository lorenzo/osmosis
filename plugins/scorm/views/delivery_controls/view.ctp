<div class="deliveryControl">
<h2><?php  __('DeliveryControl');?></h2>
	<dl>
		<dt class="altrow">Id</dt>
		<dd class="altrow">
			<?php echo $deliveryControl['DeliveryControl']['id']?>
			&nbsp;
		</dd>
		<dt>Sco Id</dt>
		<dd>
			<?php echo $deliveryControl['DeliveryControl']['sco_id']?>
			&nbsp;
		</dd>
		<dt class="altrow">Tracked</dt>
		<dd class="altrow">
			<?php echo $deliveryControl['DeliveryControl']['tracked']?>
			&nbsp;
		</dd>
		<dt>CompletionSetByContent</dt>
		<dd>
			<?php echo $deliveryControl['DeliveryControl']['completionSetByContent']?>
			&nbsp;
		</dd>
		<dt class="altrow">ObjectiveSetByContent</dt>
		<dd class="altrow">
			<?php echo $deliveryControl['DeliveryControl']['objectiveSetByContent']?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit', true).' '.__('DeliveryControl', true),   array('action'=>'edit', $deliveryControl['DeliveryControl']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete', true).' '.__('DeliveryControl', true), array('action'=>'delete', $deliveryControl['DeliveryControl']['id']), null, __('Are you sure you want to delete', true).' #' . $deliveryControl['DeliveryControl']['id'] . '?'); ?> </li>
		<li><?php echo $html->link(__('List', true).' '.__('DeliveryControls', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('DeliveryControl', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
