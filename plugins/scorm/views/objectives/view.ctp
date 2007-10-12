<div class="objective">
<h2><?php  __('Objective');?></h2>
	<dl>
		<dt class="altrow">Id</dt>
		<dd class="altrow">
			<?php echo $objective['Objective']['id']?>
			&nbsp;
		</dd>
		<dt>Sco Id</dt>
		<dd>
			<?php echo $objective['Objective']['sco_id']?>
			&nbsp;
		</dd>
		<dt class="altrow">SatisfiedByMeasure</dt>
		<dd class="altrow">
			<?php echo $objective['Objective']['satisfiedByMeasure']?>
			&nbsp;
		</dd>
		<dt>MinNormalizedMeasure</dt>
		<dd>
			<?php echo $objective['Objective']['minNormalizedMeasure']?>
			&nbsp;
		</dd>
		<dt class="altrow">ObjectiveID</dt>
		<dd class="altrow">
			<?php echo $objective['Objective']['objectiveID']?>
			&nbsp;
		</dd>
		<dt>Primary</dt>
		<dd>
			<?php echo $objective['Objective']['primary']?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit', true).' '.__('Objective', true),   array('action'=>'edit', $objective['Objective']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete', true).' '.__('Objective', true), array('action'=>'delete', $objective['Objective']['id']), null, __('Are you sure you want to delete', true).' #' . $objective['Objective']['id'] . '?'); ?> </li>
		<li><?php echo $html->link(__('List', true).' '.__('Objectives', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Objective', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List', true).' '.__('Map Infos', true), array('controller'=> 'map_infos', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Map Info', true), array('controller'=> 'map_infos', 'action'=>'add')); ?> </li>
	</ul>
</div>

Notice: Trying to get property of non-object in /home/joaquin/sitios/cake1.2.x/cake/console/libs/templates/views/view.ctp on line 94

Notice: Trying to get property of non-object in /home/joaquin/sitios/cake1.2.x/cake/console/libs/templates/views/view.ctp on line 94

Notice: Trying to get property of non-object in /home/joaquin/sitios/cake1.2.x/cake/console/libs/templates/views/view.ctp on line 95
<div class="related">
	<h3><?php  __('Related');?> <?php __('Map Info');?></h3>
	<?php if (!empty($objective['MapInfo'])):?>
	<dl>

Warning: Invalid argument supplied for foreach() in /home/joaquin/sitios/cake1.2.x/cake/console/libs/templates/views/view.ctp on line 103
	</dl>
	<?php endif; ?>
	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('Edit', true).' '.__('Map Info', true), array('controller'=> 'map_infos', 'action'=>'edit', $objective['MapInfo']['']));?></li>
		</ul>
	</div>
</div>
