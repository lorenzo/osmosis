<div class="condition">
<h2><?php  __('Condition');?></h2>
	<dl>
		<dt class="altrow">Id</dt>
		<dd class="altrow">
			<?php echo $condition['Condition']['id']?>
			&nbsp;
		</dd>
		<dt>ReferencedObjective</dt>
		<dd>
			<?php echo $condition['Condition']['referencedObjective']?>
			&nbsp;
		</dd>
		<dt class="altrow">MeasureThreshold</dt>
		<dd class="altrow">
			<?php echo $condition['Condition']['measureThreshold']?>
			&nbsp;
		</dd>
		<dt>Operator</dt>
		<dd>
			<?php echo $condition['Condition']['operator']?>
			&nbsp;
		</dd>
		<dt class="altrow">RuleCondition</dt>
		<dd class="altrow">
			<?php echo $condition['Condition']['ruleCondition']?>
			&nbsp;
		</dd>
		<dt>Rule</dt>
		<dd>
			<?php echo $html->link($condition['Rule']['id'], array('controller'=> 'rules', 'action'=>'view', $condition['Rule']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit', true).' '.__('Condition', true),   array('action'=>'edit', $condition['Condition']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete', true).' '.__('Condition', true), array('action'=>'delete', $condition['Condition']['id']), null, __('Are you sure you want to delete', true).' #' . $condition['Condition']['id'] . '?'); ?> </li>
		<li><?php echo $html->link(__('List', true).' '.__('Conditions', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Condition', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List', true).' '.__('Rules', true), array('controller'=> 'rules', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Rule', true), array('controller'=> 'rules', 'action'=>'add')); ?> </li>
	</ul>
</div>
