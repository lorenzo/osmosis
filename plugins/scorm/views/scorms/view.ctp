<div class="scorm">
<h2><?php  __('Scorm');?></h2>
	<dl>
		<dt class="altrow">Id</dt>
		<dd class="altrow">
			<?php echo $scorm['Scorm']['id']?>
			&nbsp;
		</dd>
		<dt>Course Id</dt>
		<dd>
			<?php echo $scorm['Scorm']['course_id']?>
			&nbsp;
		</dd>
		<dt class="altrow">Name</dt>
		<dd class="altrow">
			<?php echo $scorm['Scorm']['name']?>
			&nbsp;
		</dd>
		<dt>File Name</dt>
		<dd>
			<?php echo $scorm['Scorm']['file_name']?>
			&nbsp;
		</dd>
		<dt class="altrow">Description</dt>
		<dd class="altrow">
			<?php echo $scorm['Scorm']['description']?>
			&nbsp;
		</dd>
		<dt>Version</dt>
		<dd>
			<?php echo $scorm['Scorm']['version']?>
			&nbsp;
		</dd>
		<dt class="altrow">Created</dt>
		<dd class="altrow">
			<?php echo $scorm['Scorm']['created']?>
			&nbsp;
		</dd>
		<dt>Modified</dt>
		<dd>
			<?php echo $scorm['Scorm']['modified']?>
			&nbsp;
		</dd>
		<dt class="altrow">Hash</dt>
		<dd class="altrow">
			<?php echo $scorm['Scorm']['hash']?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit', true).' '.__('Scorm', true),   array('action'=>'edit', $scorm['Scorm']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete', true).' '.__('Scorm', true), array('action'=>'delete', $scorm['Scorm']['id']), null, __('Are you sure you want to delete', true).' #' . $scorm['Scorm']['id'] . '?'); ?> </li>
		<li><?php echo $html->link(__('List', true).' '.__('Scorms', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Scorm', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List', true).' '.__('Scos', true), array('controller'=> 'scos', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Sco', true), array('controller'=> 'scos', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php  __('Related');?> <?php __('Scos');?></h3>
	<?php if (!empty($scorm['Sco'])):?>
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
		foreach ($scorm['Sco'] as $sco):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $sco['id'];?></td>
			<td><?php echo $sco['scorm_id'];?></td>
			<td><?php echo $sco['parent_id'];?></td>
			<td><?php echo $sco['manifest'];?></td>
			<td><?php echo $sco['organization'];?></td>
			<td><?php echo $sco['identifier'];?></td>
			<td><?php echo $sco['href'];?></td>
			<td><?php echo $sco['title'];?></td>
			<td><?php echo $sco['completionThreshold'];?></td>
			<td><?php echo $sco['parameters'];?></td>
			<td><?php echo $sco['isvisible'];?></td>
			<td><?php echo $sco['attemptAbsoluteDurationLimit'];?></td>
			<td><?php echo $sco['dataFromLMS'];?></td>
			<td><?php echo $sco['attemptLimit'];?></td>
			<td><?php echo $sco['scormType'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'scos', 'action'=>'view', $sco['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'scos', 'action'=>'edit', $sco['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'scos', 'action'=>'delete', $sco['id']), null, __('Are you sure you want to delete', true).' #' . $sco['id'] . '?'); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New', true).' '.__('Sco', true), array('controller'=> 'scos', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
