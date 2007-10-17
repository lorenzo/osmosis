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
	<?php echo $tree->show('Sco/title', $scos); ?>
	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New', true).' '.__('Sco', true), array('controller'=> 'scos', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
