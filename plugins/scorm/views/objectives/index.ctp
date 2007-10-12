<div class="objectives">
<h2><?php __('Objectives');?></h2>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('sco_id');?></th>
	<th><?php echo $paginator->sort('satisfiedByMeasure');?></th>
	<th><?php echo $paginator->sort('minNormalizedMeasure');?></th>
	<th><?php echo $paginator->sort('objectiveID');?></th>
	<th><?php echo $paginator->sort('primary');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($objectives as $objective):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $objective['Objective']['id']?>
		</td>
		<td>
			<?php echo $objective['Objective']['sco_id']?>
		</td>
		<td>
			<?php echo $objective['Objective']['satisfiedByMeasure']?>
		</td>
		<td>
			<?php echo $objective['Objective']['minNormalizedMeasure']?>
		</td>
		<td>
			<?php echo $objective['Objective']['objectiveID']?>
		</td>
		<td>
			<?php echo $objective['Objective']['primary']?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $objective['Objective']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $objective['Objective']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $objective['Objective']['id']), null, __('Are you sure you want to delete', true).' #' . $objective['Objective']['id']); ?>
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
		<li><?php echo $html->link(__('New', true).' '.__('Objective', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List', true).' '.__('Map Infos', true), array('controller'=> 'map_infos', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Map Info', true), array('controller'=> 'map_infos', 'action'=>'add')); ?> </li>
	</ul>
</div>