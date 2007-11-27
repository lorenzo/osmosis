<div class="course">
<h2><?php  __('Course');?></h2>
	<dl>
		<dt class="altrow"><?php __('Id') ?></dt>
		<dd class="altrow">
			<?php echo $course['Course']['id'] ?>
			&nbsp;
		</dd>
		<dt><?php __('Department') ?></dt>
		<dd>
			<?php echo $html->link(__($course['Department']['name'], true), array('controller'=> 'departments', 'action'=>'view', $course['Department']['id'])); ?>
			&nbsp;
		</dd>
		<dt class="altrow"><?php __('Owner') ?></dt>
		<dd class="altrow">
			<?php echo $html->link(__($course['Owner']['id'], true), array('controller'=> 'members', 'action'=>'view', $course['Owner']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php __('Code') ?></dt>
		<dd>
			<?php echo $course['Course']['code'] ?>
			&nbsp;
		</dd>
		<dt class="altrow"><?php __('Name') ?></dt>
		<dd class="altrow">
			<?php echo $course['Course']['name'] ?>
			&nbsp;
		</dd>
		<dt><?php __('Description') ?></dt>
		<dd>
			<?php echo $course['Course']['description'] ?>
			&nbsp;
		</dd>
		<dt class="altrow"><?php __('Created') ?></dt>
		<dd class="altrow">
			<?php echo $course['Course']['created'] ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(sprintf(__('Edit %s', true), __('Course', true)), array('action'=>'edit', $course['Course']['id'])); ?> </li>
		<li><?php echo $html->link(sprintf(__('Delete %s', true), __('Course', true)), array('action'=>'delete', $course['Course']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $course['Course']['id'])); ?> </li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Courses', true)), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('Course', true)), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Departments', true)), array('controller'=> 'departments', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('Department', true)), array('controller'=> 'departments', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Members', true)), array('controller'=> 'members', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('Member', true)), array('controller'=> 'members', 'action'=>'add')); ?> </li>
	</ul>
</div>
