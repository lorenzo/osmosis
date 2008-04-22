<div class="plugins view">
<h2><?php  __('Plugin');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $plugin['Plugin']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $plugin['Plugin']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Active'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $plugin['Plugin']['active']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Folder'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $plugin['Plugin']['folder']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Plugin', true), array('action'=>'edit', $plugin['Plugin']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Plugin', true), array('action'=>'delete', $plugin['Plugin']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $plugin['Plugin']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Plugins', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Plugin', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Courses', true), array('controller'=> 'courses', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Course', true), array('controller'=> 'courses', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Courses');?></h3>
	<?php if (!empty($plugin['Course'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Department Id'); ?></th>
		<th><?php __('Owner Id'); ?></th>
		<th><?php __('Code'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Created'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($plugin['Course'] as $course):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $course['id'];?></td>
			<td><?php echo $course['department_id'];?></td>
			<td><?php echo $course['owner_id'];?></td>
			<td><?php echo $course['code'];?></td>
			<td><?php echo $course['name'];?></td>
			<td><?php echo $course['description'];?></td>
			<td><?php echo $course['created'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'courses', 'action'=>'view', $course['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'courses', 'action'=>'edit', $course['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'courses', 'action'=>'delete', $course['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $course['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Course', true), array('controller'=> 'courses', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
