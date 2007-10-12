<div class="scoPresentations">
<h2><?php __('ScoPresentations');?></h2>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('hideKey');?></th>
	<th><?php echo $paginator->sort('sco_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($scoPresentations as $scoPresentation):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $scoPresentation['ScoPresentation']['id']?>
		</td>
		<td>
			<?php echo $scoPresentation['ScoPresentation']['hideKey']?>
		</td>
		<td>
			<?php echo $scoPresentation['ScoPresentation']['sco_id']?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $scoPresentation['ScoPresentation']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $scoPresentation['ScoPresentation']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $scoPresentation['ScoPresentation']['id']), null, __('Are you sure you want to delete', true).' #' . $scoPresentation['ScoPresentation']['id']); ?>
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
		<li><?php echo $html->link(__('New', true).' '.__('ScoPresentation', true), array('action'=>'add')); ?></li>
	</ul>
</div>