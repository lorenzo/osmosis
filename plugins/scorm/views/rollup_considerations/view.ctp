<div class="rollupConsideration">
<h2><?php  __('RollupConsideration');?></h2>
	<dl>
		<dt class="altrow">Id</dt>
		<dd class="altrow">
			<?php echo $rollupConsideration['RollupConsideration']['id']?>
			&nbsp;
		</dd>
		<dt>Sco Id</dt>
		<dd>
			<?php echo $rollupConsideration['RollupConsideration']['sco_id']?>
			&nbsp;
		</dd>
		<dt class="altrow">RequiredForSatisfied</dt>
		<dd class="altrow">
			<?php echo $rollupConsideration['RollupConsideration']['requiredForSatisfied']?>
			&nbsp;
		</dd>
		<dt>RequiredForNotSatisfied</dt>
		<dd>
			<?php echo $rollupConsideration['RollupConsideration']['requiredForNotSatisfied']?>
			&nbsp;
		</dd>
		<dt class="altrow">RequiredForComplete</dt>
		<dd class="altrow">
			<?php echo $rollupConsideration['RollupConsideration']['requiredForComplete']?>
			&nbsp;
		</dd>
		<dt>RequiredForIncomplete</dt>
		<dd>
			<?php echo $rollupConsideration['RollupConsideration']['requiredForIncomplete']?>
			&nbsp;
		</dd>
		<dt class="altrow">MeasureSatisfactionIfActive</dt>
		<dd class="altrow">
			<?php echo $rollupConsideration['RollupConsideration']['measureSatisfactionIfActive']?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit', true).' '.__('RollupConsideration', true),   array('action'=>'edit', $rollupConsideration['RollupConsideration']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete', true).' '.__('RollupConsideration', true), array('action'=>'delete', $rollupConsideration['RollupConsideration']['id']), null, __('Are you sure you want to delete', true).' #' . $rollupConsideration['RollupConsideration']['id'] . '?'); ?> </li>
		<li><?php echo $html->link(__('List', true).' '.__('RollupConsiderations', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('RollupConsideration', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
