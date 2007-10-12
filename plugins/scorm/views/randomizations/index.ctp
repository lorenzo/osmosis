<div class="randomizations">
<h2><?php __('Randomizations');?></h2>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('sco_id');?></th>
	<th><?php echo $paginator->sort('randomizationTiming');?></th>
	<th><?php echo $paginator->sort('selectCount');?></th>
	<th><?php echo $paginator->sort('reorderChildren');?></th>
	<th><?php echo $paginator->sort('selectionTiming');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($randomizations as $randomization):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $randomization['Randomization']['id']?>
		</td>
		<td>
			<?php echo $randomization['Randomization']['sco_id']?>
		</td>
		<td>
			<?php echo $randomization['Randomization']['randomizationTiming']?>
		</td>
		<td>
			<?php echo $randomization['Randomization']['selectCount']?>
		</td>
		<td>
			<?php echo $randomization['Randomization']['reorderChildren']?>
		</td>
		<td>
			<?php echo $randomization['Randomization']['selectionTiming']?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $randomization['Randomization']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $randomization['Randomization']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $randomization['Randomization']['id']), null, __('Are you sure you want to delete', true).' #' . $randomization['Randomization']['id']); ?>
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
		<li><?php echo $html->link(__('New', true).' '.__('Randomization', true), array('action'=>'add')); ?></li>
	</ul>
</div>