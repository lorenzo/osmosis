<div class="deliveryControls">
<h2><?php __('DeliveryControls');?></h2>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('sco_id');?></th>
	<th><?php echo $paginator->sort('tracked');?></th>
	<th><?php echo $paginator->sort('completionSetByContent');?></th>
	<th><?php echo $paginator->sort('objectiveSetByContent');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($deliveryControls as $deliveryControl):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $deliveryControl['DeliveryControl']['id']?>
		</td>
		<td>
			<?php echo $deliveryControl['DeliveryControl']['sco_id']?>
		</td>
		<td>
			<?php echo $deliveryControl['DeliveryControl']['tracked']?>
		</td>
		<td>
			<?php echo $deliveryControl['DeliveryControl']['completionSetByContent']?>
		</td>
		<td>
			<?php echo $deliveryControl['DeliveryControl']['objectiveSetByContent']?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $deliveryControl['DeliveryControl']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $deliveryControl['DeliveryControl']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $deliveryControl['DeliveryControl']['id']), null, __('Are you sure you want to delete', true).' #' . $deliveryControl['DeliveryControl']['id']); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New', true).' '.__('DeliveryControl', true), array('action'=>'add')); ?></li>
	</ul>
</div>