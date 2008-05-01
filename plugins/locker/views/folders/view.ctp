<div class="lockerFolders view">
<h2><?php  __('LockerFolder');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $lockerFolder['LockerFolder']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $lockerFolder['LockerFolder']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Parent Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $lockerFolder['LockerFolder']['parent_id']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit LockerFolder', true), array('action'=>'edit', $lockerFolder['LockerFolder']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete LockerFolder', true), array('action'=>'delete', $lockerFolder['LockerFolder']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $lockerFolder['LockerFolder']['id'])); ?> </li>
		<li><?php echo $html->link(__('List LockerFolders', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New LockerFolder', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
