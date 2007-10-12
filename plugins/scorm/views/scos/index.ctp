<div class="scos">
<h2><?php __('Scos');?></h2>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('scorm_id');?></th>
	<th><?php echo $paginator->sort('parent_id');?></th>
	<th><?php echo $paginator->sort('manifest');?></th>
	<th><?php echo $paginator->sort('organization');?></th>
	<th><?php echo $paginator->sort('identifier');?></th>
	<th><?php echo $paginator->sort('href');?></th>
	<th><?php echo $paginator->sort('title');?></th>
	<th><?php echo $paginator->sort('completionThreshold');?></th>
	<th><?php echo $paginator->sort('parameters');?></th>
	<th><?php echo $paginator->sort('isvisible');?></th>
	<th><?php echo $paginator->sort('attemptAbsoluteDurationLimit');?></th>
	<th><?php echo $paginator->sort('dataFromLMS');?></th>
	<th><?php echo $paginator->sort('attemptLimit');?></th>
	<th><?php echo $paginator->sort('scormType');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($scos as $sco):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $sco['Sco']['id']?>
		</td>
		<td>
			<?php echo $sco['Sco']['scorm_id']?>
		</td>
		<td>
			<?php echo $html->link($sco['SubItem']['title'], array('controller'=> 'scos', 'action'=>'view', $sco['SubItem']['id'])); ?>
		</td>
		<td>
			<?php echo $sco['Sco']['manifest']?>
		</td>
		<td>
			<?php echo $sco['Sco']['organization']?>
		</td>
		<td>
			<?php echo $sco['Sco']['identifier']?>
		</td>
		<td>
			<?php echo $sco['Sco']['href']?>
		</td>
		<td>
			<?php echo $sco['Sco']['title']?>
		</td>
		<td>
			<?php echo $sco['Sco']['completionThreshold']?>
		</td>
		<td>
			<?php echo $sco['Sco']['parameters']?>
		</td>
		<td>
			<?php echo $sco['Sco']['isvisible']?>
		</td>
		<td>
			<?php echo $sco['Sco']['attemptAbsoluteDurationLimit']?>
		</td>
		<td>
			<?php echo $sco['Sco']['dataFromLMS']?>
		</td>
		<td>
			<?php echo $sco['Sco']['attemptLimit']?>
		</td>
		<td>
			<?php echo $sco['Sco']['scormType']?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $sco['Sco']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $sco['Sco']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $sco['Sco']['id']), null, __('Are you sure you want to delete', true).' #' . $sco['Sco']['id']); ?>
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
		<li><?php echo $html->link(__('New', true).' '.__('Sco', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List', true).' '.__('Objectives', true), array('controller'=> 'objectives', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Objective', true), array('controller'=> 'objectives', 'action'=>'add')); ?> </li>
	</ul>
</div>