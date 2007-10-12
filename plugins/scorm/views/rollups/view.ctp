<div class="rollup">
<h2><?php  __('Rollup');?></h2>
	<dl>
		<dt class="altrow">Id</dt>
		<dd class="altrow">
			<?php echo $rollup['Rollup']['id']?>
			&nbsp;
		</dd>
		<dt>Sco Id</dt>
		<dd>
			<?php echo $rollup['Rollup']['sco_id']?>
			&nbsp;
		</dd>
		<dt class="altrow">RollupObjectiveSatisfied</dt>
		<dd class="altrow">
			<?php echo $rollup['Rollup']['rollupObjectiveSatisfied']?>
			&nbsp;
		</dd>
		<dt>RollupProgressCompletion</dt>
		<dd>
			<?php echo $rollup['Rollup']['rollupProgressCompletion']?>
			&nbsp;
		</dd>
		<dt class="altrow">ObjectiveMeasureWeight</dt>
		<dd class="altrow">
			<?php echo $rollup['Rollup']['objectiveMeasureWeight']?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit', true).' '.__('Rollup', true),   array('action'=>'edit', $rollup['Rollup']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete', true).' '.__('Rollup', true), array('action'=>'delete', $rollup['Rollup']['id']), null, __('Are you sure you want to delete', true).' #' . $rollup['Rollup']['id'] . '?'); ?> </li>
		<li><?php echo $html->link(__('List', true).' '.__('Rollups', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Rollup', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List', true).' '.__('Rules', true), array('controller'=> 'rules', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Rule', true), array('controller'=> 'rules', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php  __('Related');?> <?php __('Rules');?></h3>
	<?php if (!empty($rollup['Rule'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th>Id</th>
		<th>Sco Id</th>
		<th>Type</th>
		<th>ConditionCombination</th>
		<th>Action</th>
		<th>MinimumPercent</th>
		<th>MinimumCount</th>
		<th>Rollup Id</th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($rollup['Rule'] as $rule):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $rule['id'];?></td>
			<td><?php echo $rule['sco_id'];?></td>
			<td><?php echo $rule['type'];?></td>
			<td><?php echo $rule['conditionCombination'];?></td>
			<td><?php echo $rule['action'];?></td>
			<td><?php echo $rule['minimumPercent'];?></td>
			<td><?php echo $rule['minimumCount'];?></td>
			<td><?php echo $rule['rollup_id'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'rules', 'action'=>'view', $rule['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'rules', 'action'=>'edit', $rule['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'rules', 'action'=>'delete', $rule['id']), null, __('Are you sure you want to delete', true).' #' . $rule['id'] . '?'); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New', true).' '.__('Rule', true), array('controller'=> 'rules', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
