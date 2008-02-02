<div class="lockers view">
<h2><?php  __('Locker');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $locker['Locker']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Member Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $locker['Locker']['member_id']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Locker', true), array('action'=>'edit', $locker['Locker']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Locker', true), array('action'=>'delete', $locker['Locker']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $locker['Locker']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Lockers', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Locker', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
