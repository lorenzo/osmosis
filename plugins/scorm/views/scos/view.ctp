<div class="sco">
<h2><?php  __('Sco');?></h2>
	<dl>
		<dt class="altrow">Id</dt>
		<dd class="altrow">
			<?php echo $sco['Sco']['id']?>
			&nbsp;
		</dd>
		<dt>Scorm Id</dt>
		<dd>
			<?php echo $sco['Sco']['scorm_id']?>
			&nbsp;
		</dd>
		<dt class="altrow">SubItem</dt>
		<dd class="altrow">
			<?php echo $html->link($sco['SubItem']['title'], array('controller'=> 'scos', 'action'=>'view', $sco['SubItem']['id'])); ?>
			&nbsp;
		</dd>
		<dt>Manifest</dt>
		<dd>
			<?php echo $sco['Sco']['manifest']?>
			&nbsp;
		</dd>
		<dt class="altrow">Organization</dt>
		<dd class="altrow">
			<?php echo $sco['Sco']['organization']?>
			&nbsp;
		</dd>
		<dt>Identifier</dt>
		<dd>
			<?php echo $sco['Sco']['identifier']?>
			&nbsp;
		</dd>
		<dt class="altrow">Href</dt>
		<dd class="altrow">
			<?php echo $sco['Sco']['href']?>
			&nbsp;
		</dd>
		<dt>Title</dt>
		<dd>
			<?php echo $sco['Sco']['title']?>
			&nbsp;
		</dd>
		<dt class="altrow">CompletionThreshold</dt>
		<dd class="altrow">
			<?php echo $sco['Sco']['completionThreshold']?>
			&nbsp;
		</dd>
		<dt>Parameters</dt>
		<dd>
			<?php echo $sco['Sco']['parameters']?>
			&nbsp;
		</dd>
		<dt class="altrow">Isvisible</dt>
		<dd class="altrow">
			<?php echo $sco['Sco']['isvisible']?>
			&nbsp;
		</dd>
		<dt>AttemptAbsoluteDurationLimit</dt>
		<dd>
			<?php echo $sco['Sco']['attemptAbsoluteDurationLimit']?>
			&nbsp;
		</dd>
		<dt class="altrow">DataFromLMS</dt>
		<dd class="altrow">
			<?php echo $sco['Sco']['dataFromLMS']?>
			&nbsp;
		</dd>
		<dt>AttemptLimit</dt>
		<dd>
			<?php echo $sco['Sco']['attemptLimit']?>
			&nbsp;
		</dd>
		<dt class="altrow">ScormType</dt>
		<dd class="altrow">
			<?php echo $sco['Sco']['scormType']?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit', true).' '.__('Sco', true),   array('action'=>'edit', $sco['Sco']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete', true).' '.__('Sco', true), array('action'=>'delete', $sco['Sco']['id']), null, __('Are you sure you want to delete', true).' #' . $sco['Sco']['id'] . '?'); ?> </li>
		<li><?php echo $html->link(__('List', true).' '.__('Scos', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Sco', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List', true).' '.__('Objectives', true), array('controller'=> 'objectives', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Objective', true), array('controller'=> 'objectives', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php  __('Related');?> <?php __('Primary Objective');?></h3>
	<?php if (!empty($sco['PrimaryObjective'])):?>
	<dl>
		<dt class="altrow">Id</dt>
		<dd class="altrow">
	<?php echo $sco['PrimaryObjective']['id'] ?>
&nbsp;</dd>
		<dt>Sco Id</dt>
		<dd>
	<?php echo $sco['PrimaryObjective']['sco_id'] ?>
&nbsp;</dd>
		<dt class="altrow">SatisfiedByMeasure</dt>
		<dd class="altrow">
	<?php echo $sco['PrimaryObjective']['satisfiedByMeasure'] ?>
&nbsp;</dd>
		<dt>MinNormalizedMeasure</dt>
		<dd>
	<?php echo $sco['PrimaryObjective']['minNormalizedMeasure'] ?>
&nbsp;</dd>
		<dt class="altrow">ObjectiveID</dt>
		<dd class="altrow">
	<?php echo $sco['PrimaryObjective']['objectiveID'] ?>
&nbsp;</dd>
		<dt>Primary</dt>
		<dd>
	<?php echo $sco['PrimaryObjective']['primary'] ?>
&nbsp;</dd>
	</dl>
	<?php endif; ?>
	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('Edit', true).' '.__('Primary Objective', true), array('controller'=> 'objectives', 'action'=>'edit', $sco['PrimaryObjective']['id']));?></li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php  __('Related');?> <?php __('Randomization');?></h3>
	<?php if (!empty($sco['Randomization'])):?>
	<dl>
		<dt class="altrow">Id</dt>
		<dd class="altrow">
	<?php echo $sco['Randomization']['id'] ?>
&nbsp;</dd>
		<dt>Sco Id</dt>
		<dd>
	<?php echo $sco['Randomization']['sco_id'] ?>
&nbsp;</dd>
		<dt class="altrow">RandomizationTiming</dt>
		<dd class="altrow">
	<?php echo $sco['Randomization']['randomizationTiming'] ?>
&nbsp;</dd>
		<dt>SelectCount</dt>
		<dd>
	<?php echo $sco['Randomization']['selectCount'] ?>
&nbsp;</dd>
		<dt class="altrow">ReorderChildren</dt>
		<dd class="altrow">
	<?php echo $sco['Randomization']['reorderChildren'] ?>
&nbsp;</dd>
		<dt>SelectionTiming</dt>
		<dd>
	<?php echo $sco['Randomization']['selectionTiming'] ?>
&nbsp;</dd>
	</dl>
	<?php endif; ?>
	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('Edit', true).' '.__('Randomization', true), array('controller'=> 'randomizations', 'action'=>'edit', $sco['Randomization']['id']));?></li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php  __('Related');?> <?php __('Rollup');?></h3>
	<?php if (!empty($sco['Rollup'])):?>
	<dl>
		<dt class="altrow">Id</dt>
		<dd class="altrow">
	<?php echo $sco['Rollup']['id'] ?>
&nbsp;</dd>
		<dt>Sco Id</dt>
		<dd>
	<?php echo $sco['Rollup']['sco_id'] ?>
&nbsp;</dd>
		<dt class="altrow">RollupObjectiveSatisfied</dt>
		<dd class="altrow">
	<?php echo $sco['Rollup']['rollupObjectiveSatisfied'] ?>
&nbsp;</dd>
		<dt>RollupProgressCompletion</dt>
		<dd>
	<?php echo $sco['Rollup']['rollupProgressCompletion'] ?>
&nbsp;</dd>
		<dt class="altrow">ObjectiveMeasureWeight</dt>
		<dd class="altrow">
	<?php echo $sco['Rollup']['objectiveMeasureWeight'] ?>
&nbsp;</dd>
	</dl>
	<?php endif; ?>
	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('Edit', true).' '.__('Rollup', true), array('controller'=> 'rollups', 'action'=>'edit', $sco['Rollup']['id']));?></li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php  __('Related');?> <?php __('Choice');?></h3>
	<?php if (!empty($sco['Choice'])):?>
	<dl>
		<dt class="altrow">Id</dt>
		<dd class="altrow">
	<?php echo $sco['Choice']['id'] ?>
&nbsp;</dd>
		<dt>Sco Id</dt>
		<dd>
	<?php echo $sco['Choice']['sco_id'] ?>
&nbsp;</dd>
		<dt class="altrow">PreventActivation</dt>
		<dd class="altrow">
	<?php echo $sco['Choice']['preventActivation'] ?>
&nbsp;</dd>
		<dt>ConstrainChoice</dt>
		<dd>
	<?php echo $sco['Choice']['constrainChoice'] ?>
&nbsp;</dd>
	</dl>
	<?php endif; ?>
	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('Edit', true).' '.__('Choice', true), array('controller'=> 'choice_considerations', 'action'=>'edit', $sco['Choice']['id']));?></li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php  __('Related');?> <?php __('Consideration');?></h3>
	<?php if (!empty($sco['Consideration'])):?>
	<dl>
		<dt class="altrow">Id</dt>
		<dd class="altrow">
	<?php echo $sco['Consideration']['id'] ?>
&nbsp;</dd>
		<dt>Sco Id</dt>
		<dd>
	<?php echo $sco['Consideration']['sco_id'] ?>
&nbsp;</dd>
		<dt class="altrow">RequiredForSatisfied</dt>
		<dd class="altrow">
	<?php echo $sco['Consideration']['requiredForSatisfied'] ?>
&nbsp;</dd>
		<dt>RequiredForNotSatisfied</dt>
		<dd>
	<?php echo $sco['Consideration']['requiredForNotSatisfied'] ?>
&nbsp;</dd>
		<dt class="altrow">RequiredForComplete</dt>
		<dd class="altrow">
	<?php echo $sco['Consideration']['requiredForComplete'] ?>
&nbsp;</dd>
		<dt>RequiredForIncomplete</dt>
		<dd>
	<?php echo $sco['Consideration']['requiredForIncomplete'] ?>
&nbsp;</dd>
		<dt class="altrow">MeasureSatisfactionIfActive</dt>
		<dd class="altrow">
	<?php echo $sco['Consideration']['measureSatisfactionIfActive'] ?>
&nbsp;</dd>
	</dl>
	<?php endif; ?>
	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('Edit', true).' '.__('Consideration', true), array('controller'=> 'rollup_considerations', 'action'=>'edit', $sco['Consideration']['id']));?></li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php  __('Related');?> <?php __('Control');?></h3>
	<?php if (!empty($sco['Control'])):?>
	<dl>
		<dt class="altrow">Id</dt>
		<dd class="altrow">
	<?php echo $sco['Control']['id'] ?>
&nbsp;</dd>
		<dt>Sco Id</dt>
		<dd>
	<?php echo $sco['Control']['sco_id'] ?>
&nbsp;</dd>
		<dt class="altrow">ChoiceExit</dt>
		<dd class="altrow">
	<?php echo $sco['Control']['choiceExit'] ?>
&nbsp;</dd>
		<dt>Choice</dt>
		<dd>
	<?php echo $sco['Control']['choice'] ?>
&nbsp;</dd>
		<dt class="altrow">Flow</dt>
		<dd class="altrow">
	<?php echo $sco['Control']['flow'] ?>
&nbsp;</dd>
		<dt>ForwardOnly</dt>
		<dd>
	<?php echo $sco['Control']['forwardOnly'] ?>
&nbsp;</dd>
		<dt class="altrow">UseCurrentAttemptObjectiveInfo</dt>
		<dd class="altrow">
	<?php echo $sco['Control']['useCurrentAttemptObjectiveInfo'] ?>
&nbsp;</dd>
		<dt>UseCurrentAttemptProgressInfo</dt>
		<dd>
	<?php echo $sco['Control']['useCurrentAttemptProgressInfo'] ?>
&nbsp;</dd>
	</dl>
	<?php endif; ?>
	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('Edit', true).' '.__('Control', true), array('controller'=> 'control_modes', 'action'=>'edit', $sco['Control']['id']));?></li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php  __('Related');?> <?php __('Delivery Control');?></h3>
	<?php if (!empty($sco['DeliveryControl'])):?>
	<dl>
		<dt class="altrow">Id</dt>
		<dd class="altrow">
	<?php echo $sco['DeliveryControl']['id'] ?>
&nbsp;</dd>
		<dt>Sco Id</dt>
		<dd>
	<?php echo $sco['DeliveryControl']['sco_id'] ?>
&nbsp;</dd>
		<dt class="altrow">Tracked</dt>
		<dd class="altrow">
	<?php echo $sco['DeliveryControl']['tracked'] ?>
&nbsp;</dd>
		<dt>CompletionSetByContent</dt>
		<dd>
	<?php echo $sco['DeliveryControl']['completionSetByContent'] ?>
&nbsp;</dd>
		<dt class="altrow">ObjectiveSetByContent</dt>
		<dd class="altrow">
	<?php echo $sco['DeliveryControl']['objectiveSetByContent'] ?>
&nbsp;</dd>
	</dl>
	<?php endif; ?>
	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('Edit', true).' '.__('Delivery Control', true), array('controller'=> 'delivery_controls', 'action'=>'edit', $sco['DeliveryControl']['id']));?></li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php  __('Related');?> <?php __('Sub Items');?></h3>
	<?php if (!empty($sco['SubItem'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th>Id</th>
		<th>Scorm Id</th>
		<th>Parent Id</th>
		<th>Manifest</th>
		<th>Organization</th>
		<th>Identifier</th>
		<th>Href</th>
		<th>Title</th>
		<th>CompletionThreshold</th>
		<th>Parameters</th>
		<th>Isvisible</th>
		<th>AttemptAbsoluteDurationLimit</th>
		<th>DataFromLMS</th>
		<th>AttemptLimit</th>
		<th>ScormType</th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($sco['SubItem'] as $subItem):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $subItem['id'];?></td>
			<td><?php echo $subItem['scorm_id'];?></td>
			<td><?php echo $subItem['parent_id'];?></td>
			<td><?php echo $subItem['manifest'];?></td>
			<td><?php echo $subItem['organization'];?></td>
			<td><?php echo $subItem['identifier'];?></td>
			<td><?php echo $subItem['href'];?></td>
			<td><?php echo $subItem['title'];?></td>
			<td><?php echo $subItem['completionThreshold'];?></td>
			<td><?php echo $subItem['parameters'];?></td>
			<td><?php echo $subItem['isvisible'];?></td>
			<td><?php echo $subItem['attemptAbsoluteDurationLimit'];?></td>
			<td><?php echo $subItem['dataFromLMS'];?></td>
			<td><?php echo $subItem['attemptLimit'];?></td>
			<td><?php echo $subItem['scormType'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'scos', 'action'=>'view', $subItem['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'scos', 'action'=>'edit', $subItem['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'scos', 'action'=>'delete', $subItem['id']), null, __('Are you sure you want to delete', true).' #' . $subItem['id'] . '?'); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New', true).' '.__('Sub Item', true), array('controller'=> 'scos', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php  __('Related');?> <?php __('Objectives');?></h3>
	<?php if (!empty($sco['Objective'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th>Id</th>
		<th>Sco Id</th>
		<th>SatisfiedByMeasure</th>
		<th>MinNormalizedMeasure</th>
		<th>ObjectiveID</th>
		<th>Primary</th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($sco['Objective'] as $objective):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $objective['id'];?></td>
			<td><?php echo $objective['sco_id'];?></td>
			<td><?php echo $objective['satisfiedByMeasure'];?></td>
			<td><?php echo $objective['minNormalizedMeasure'];?></td>
			<td><?php echo $objective['objectiveID'];?></td>
			<td><?php echo $objective['primary'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'objectives', 'action'=>'view', $objective['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'objectives', 'action'=>'edit', $objective['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'objectives', 'action'=>'delete', $objective['id']), null, __('Are you sure you want to delete', true).' #' . $objective['id'] . '?'); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New', true).' '.__('Objective', true), array('controller'=> 'objectives', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php  __('Related');?> <?php __('Rules');?></h3>
	<?php if (!empty($sco['Rule'])):?>
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
		foreach ($sco['Rule'] as $rule):
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
<div class="related">
	<h3><?php  __('Related');?> <?php __('Presentations');?></h3>
	<?php if (!empty($sco['Presentation'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th>Id</th>
		<th>HideKey</th>
		<th>Sco Id</th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($sco['Presentation'] as $presentation):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $presentation['id'];?></td>
			<td><?php echo $presentation['hideKey'];?></td>
			<td><?php echo $presentation['sco_id'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'sco_presentations', 'action'=>'view', $presentation['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'sco_presentations', 'action'=>'edit', $presentation['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'sco_presentations', 'action'=>'delete', $presentation['id']), null, __('Are you sure you want to delete', true).' #' . $presentation['id'] . '?'); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New', true).' '.__('Presentation', true), array('controller'=> 'sco_presentations', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
