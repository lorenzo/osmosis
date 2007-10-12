<div class="rule">
<h2><?php  __('Rule');?></h2>
	<dl>
		<dt class="altrow">Id</dt>
		<dd class="altrow">
			<?php echo $rule['Rule']['id']?>
			&nbsp;
		</dd>
		<dt>Sco Id</dt>
		<dd>
			<?php echo $rule['Rule']['sco_id']?>
			&nbsp;
		</dd>
		<dt class="altrow">Type</dt>
		<dd class="altrow">
			<?php echo $rule['Rule']['type']?>
			&nbsp;
		</dd>
		<dt>ConditionCombination</dt>
		<dd>
			<?php echo $rule['Rule']['conditionCombination']?>
			&nbsp;
		</dd>
		<dt class="altrow">Action</dt>
		<dd class="altrow">
			<?php echo $rule['Rule']['action']?>
			&nbsp;
		</dd>
		<dt>MinimumPercent</dt>
		<dd>
			<?php echo $rule['Rule']['minimumPercent']?>
			&nbsp;
		</dd>
		<dt class="altrow">MinimumCount</dt>
		<dd class="altrow">
			<?php echo $rule['Rule']['minimumCount']?>
			&nbsp;
		</dd>
		<dt>Rollup Id</dt>
		<dd>
			<?php echo $rule['Rule']['rollup_id']?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit', true).' '.__('Rule', true),   array('action'=>'edit', $rule['Rule']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete', true).' '.__('Rule', true), array('action'=>'delete', $rule['Rule']['id']), null, __('Are you sure you want to delete', true).' #' . $rule['Rule']['id'] . '?'); ?> </li>
		<li><?php echo $html->link(__('List', true).' '.__('Rules', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Rule', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List', true).' '.__('Conditions', true), array('controller'=> 'conditions', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Condition', true), array('controller'=> 'conditions', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php  __('Related');?> <?php __('Conditions');?></h3>
	<?php if (!empty($rule['Condition'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th>Id</th>
		<th>ReferencedObjective</th>
		<th>MeasureThreshold</th>
		<th>Operator</th>
		<th>RuleCondition</th>
		<th>Rule Id</th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($rule['Condition'] as $condition):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $condition['id'];?></td>
			<td><?php echo $condition['referencedObjective'];?></td>
			<td><?php echo $condition['measureThreshold'];?></td>
			<td><?php echo $condition['operator'];?></td>
			<td><?php echo $condition['ruleCondition'];?></td>
			<td><?php echo $condition['rule_id'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'conditions', 'action'=>'view', $condition['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'conditions', 'action'=>'edit', $condition['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'conditions', 'action'=>'delete', $condition['id']), null, __('Are you sure you want to delete', true).' #' . $condition['id'] . '?'); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New', true).' '.__('Condition', true), array('controller'=> 'conditions', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
