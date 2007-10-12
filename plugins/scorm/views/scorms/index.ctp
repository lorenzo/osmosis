<div class="scorms">
<h2><?php __('Scorms');?></h2>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('course_id');?></th>
	<th><?php echo $paginator->sort('name');?></th>
	<th><?php echo $paginator->sort('file_name');?></th>
	<th><?php echo $paginator->sort('description');?></th>
	<th><?php echo $paginator->sort('version');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
	<th><?php echo $paginator->sort('hash');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($scorms as $scorm):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $scorm['Scorm']['id']?>
		</td>
		<td>
			<?php echo $scorm['Scorm']['course_id']?>
		</td>
		<td>
			<?php echo $scorm['Scorm']['name']?>
		</td>
		<td>
			<?php echo $scorm['Scorm']['file_name']?>
		</td>
		<td>
			<?php echo $scorm['Scorm']['description']?>
		</td>
		<td>
			<?php echo $scorm['Scorm']['version']?>
		</td>
		<td>
			<?php echo $scorm['Scorm']['created']?>
		</td>
		<td>
			<?php echo $scorm['Scorm']['modified']?>
		</td>
		<td>
			<?php echo $scorm['Scorm']['hash']?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $scorm['Scorm']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $scorm['Scorm']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $scorm['Scorm']['id']), null, __('Are you sure you want to delete', true).' #' . $scorm['Scorm']['id']); ?>
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
		<li><?php echo $html->link(__('New', true).' '.__('Scorm', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List', true).' '.__('Scos', true), array('controller'=> 'scos', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Sco', true), array('controller'=> 'scos', 'action'=>'add')); ?> </li>
	</ul>
</div>