<div class="randomization">
<h2><?php  __('Randomization');?></h2>
	<dl>
		<dt class="altrow">Id</dt>
		<dd class="altrow">
			<?php echo $randomization['Randomization']['id']?>
			&nbsp;
		</dd>
		<dt>Sco Id</dt>
		<dd>
			<?php echo $randomization['Randomization']['sco_id']?>
			&nbsp;
		</dd>
		<dt class="altrow">RandomizationTiming</dt>
		<dd class="altrow">
			<?php echo $randomization['Randomization']['randomizationTiming']?>
			&nbsp;
		</dd>
		<dt>SelectCount</dt>
		<dd>
			<?php echo $randomization['Randomization']['selectCount']?>
			&nbsp;
		</dd>
		<dt class="altrow">ReorderChildren</dt>
		<dd class="altrow">
			<?php echo $randomization['Randomization']['reorderChildren']?>
			&nbsp;
		</dd>
		<dt>SelectionTiming</dt>
		<dd>
			<?php echo $randomization['Randomization']['selectionTiming']?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit', true).' '.__('Randomization', true),   array('action'=>'edit', $randomization['Randomization']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete', true).' '.__('Randomization', true), array('action'=>'delete', $randomization['Randomization']['id']), null, __('Are you sure you want to delete', true).' #' . $randomization['Randomization']['id'] . '?'); ?> </li>
		<li><?php echo $html->link(__('List', true).' '.__('Randomizations', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Randomization', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
