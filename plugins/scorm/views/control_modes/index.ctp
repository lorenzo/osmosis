<div class="controlModes">
<h2><?php __('ControlModes');?></h2>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('sco_id');?></th>
	<th><?php echo $paginator->sort('choiceExit');?></th>
	<th><?php echo $paginator->sort('choice');?></th>
	<th><?php echo $paginator->sort('flow');?></th>
	<th><?php echo $paginator->sort('forwardOnly');?></th>
	<th><?php echo $paginator->sort('useCurrentAttemptObjectiveInfo');?></th>
	<th><?php echo $paginator->sort('useCurrentAttemptProgressInfo');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($controlModes as $controlMode):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $controlMode['ControlMode']['id']?>
		</td>
		<td>
			<?php echo $controlMode['ControlMode']['sco_id']?>
		</td>
		<td>
			<?php echo $controlMode['ControlMode']['choiceExit']?>
		</td>
		<td>
			<?php echo $controlMode['ControlMode']['choice']?>
		</td>
		<td>
			<?php echo $controlMode['ControlMode']['flow']?>
		</td>
		<td>
			<?php echo $controlMode['ControlMode']['forwardOnly']?>
		</td>
		<td>
			<?php echo $controlMode['ControlMode']['useCurrentAttemptObjectiveInfo']?>
		</td>
		<td>
			<?php echo $controlMode['ControlMode']['useCurrentAttemptProgressInfo']?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $controlMode['ControlMode']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $controlMode['ControlMode']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $controlMode['ControlMode']['id']), null, __('Are you sure you want to delete', true).' #' . $controlMode['ControlMode']['id']); ?>
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
		<li><?php echo $html->link(__('New', true).' '.__('ControlMode', true), array('action'=>'add')); ?></li>
	</ul>
</div>