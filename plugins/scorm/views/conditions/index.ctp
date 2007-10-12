<div class="conditions">
<h2><?php __('Conditions');?></h2>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('referencedObjective');?></th>
	<th><?php echo $paginator->sort('measureThreshold');?></th>
	<th><?php echo $paginator->sort('operator');?></th>
	<th><?php echo $paginator->sort('ruleCondition');?></th>
	<th><?php echo $paginator->sort('rule_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($conditions as $condition):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $condition['Condition']['id']?>
		</td>
		<td>
			<?php echo $condition['Condition']['referencedObjective']?>
		</td>
		<td>
			<?php echo $condition['Condition']['measureThreshold']?>
		</td>
		<td>
			<?php echo $condition['Condition']['operator']?>
		</td>
		<td>
			<?php echo $condition['Condition']['ruleCondition']?>
		</td>
		<td>
			<?php echo $html->link($condition['Rule']['id'], array('controller'=> 'rules', 'action'=>'view', $condition['Rule']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $condition['Condition']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $condition['Condition']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $condition['Condition']['id']), null, __('Are you sure you want to delete', true).' #' . $condition['Condition']['id']); ?>
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
		<li><?php echo $html->link(__('New', true).' '.__('Condition', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List', true).' '.__('Rules', true), array('controller'=> 'rules', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Rule', true), array('controller'=> 'rules', 'action'=>'add')); ?> </li>
	</ul>
</div>