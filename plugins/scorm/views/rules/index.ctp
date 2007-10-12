<div class="rules">
<h2><?php __('Rules');?></h2>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('sco_id');?></th>
	<th><?php echo $paginator->sort('type');?></th>
	<th><?php echo $paginator->sort('conditionCombination');?></th>
	<th><?php echo $paginator->sort('action');?></th>
	<th><?php echo $paginator->sort('minimumPercent');?></th>
	<th><?php echo $paginator->sort('minimumCount');?></th>
	<th><?php echo $paginator->sort('rollup_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($rules as $rule):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $rule['Rule']['id']?>
		</td>
		<td>
			<?php echo $rule['Rule']['sco_id']?>
		</td>
		<td>
			<?php echo $rule['Rule']['type']?>
		</td>
		<td>
			<?php echo $rule['Rule']['conditionCombination']?>
		</td>
		<td>
			<?php echo $rule['Rule']['action']?>
		</td>
		<td>
			<?php echo $rule['Rule']['minimumPercent']?>
		</td>
		<td>
			<?php echo $rule['Rule']['minimumCount']?>
		</td>
		<td>
			<?php echo $rule['Rule']['rollup_id']?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $rule['Rule']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $rule['Rule']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $rule['Rule']['id']), null, __('Are you sure you want to delete', true).' #' . $rule['Rule']['id']); ?>
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
		<li><?php echo $html->link(__('New', true).' '.__('Rule', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List', true).' '.__('Conditions', true), array('controller'=> 'conditions', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Condition', true), array('controller'=> 'conditions', 'action'=>'add')); ?> </li>
	</ul>
</div>