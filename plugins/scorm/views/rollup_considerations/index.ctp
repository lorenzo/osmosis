<div class="rollupConsiderations">
<h2><?php __('RollupConsiderations');?></h2>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('sco_id');?></th>
	<th><?php echo $paginator->sort('requiredForSatisfied');?></th>
	<th><?php echo $paginator->sort('requiredForNotSatisfied');?></th>
	<th><?php echo $paginator->sort('requiredForComplete');?></th>
	<th><?php echo $paginator->sort('requiredForIncomplete');?></th>
	<th><?php echo $paginator->sort('measureSatisfactionIfActive');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($rollupConsiderations as $rollupConsideration):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $rollupConsideration['RollupConsideration']['id']?>
		</td>
		<td>
			<?php echo $rollupConsideration['RollupConsideration']['sco_id']?>
		</td>
		<td>
			<?php echo $rollupConsideration['RollupConsideration']['requiredForSatisfied']?>
		</td>
		<td>
			<?php echo $rollupConsideration['RollupConsideration']['requiredForNotSatisfied']?>
		</td>
		<td>
			<?php echo $rollupConsideration['RollupConsideration']['requiredForComplete']?>
		</td>
		<td>
			<?php echo $rollupConsideration['RollupConsideration']['requiredForIncomplete']?>
		</td>
		<td>
			<?php echo $rollupConsideration['RollupConsideration']['measureSatisfactionIfActive']?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $rollupConsideration['RollupConsideration']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $rollupConsideration['RollupConsideration']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $rollupConsideration['RollupConsideration']['id']), null, __('Are you sure you want to delete', true).' #' . $rollupConsideration['RollupConsideration']['id']); ?>
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
		<li><?php echo $html->link(__('New', true).' '.__('RollupConsideration', true), array('action'=>'add')); ?></li>
	</ul>
</div>