<div class="rollups">
<h2><?php __('Rollups');?></h2>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('sco_id');?></th>
	<th><?php echo $paginator->sort('rollupObjectiveSatisfied');?></th>
	<th><?php echo $paginator->sort('rollupProgressCompletion');?></th>
	<th><?php echo $paginator->sort('objectiveMeasureWeight');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($rollups as $rollup):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $rollup['Rollup']['id']?>
		</td>
		<td>
			<?php echo $rollup['Rollup']['sco_id']?>
		</td>
		<td>
			<?php echo $rollup['Rollup']['rollupObjectiveSatisfied']?>
		</td>
		<td>
			<?php echo $rollup['Rollup']['rollupProgressCompletion']?>
		</td>
		<td>
			<?php echo $rollup['Rollup']['objectiveMeasureWeight']?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $rollup['Rollup']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $rollup['Rollup']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $rollup['Rollup']['id']), null, __('Are you sure you want to delete', true).' #' . $rollup['Rollup']['id']); ?>
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
		<li><?php echo $html->link(__('New', true).' '.__('Rollup', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List', true).' '.__('Rules', true), array('controller'=> 'rules', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Rule', true), array('controller'=> 'rules', 'action'=>'add')); ?> </li>
	</ul>
</div>