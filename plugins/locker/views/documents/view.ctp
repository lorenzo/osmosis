<div class="lockerDocuments view">
<h2><?php  __('LockerDocument');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $lockerDocument['LockerDocument']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $lockerDocument['LockerDocument']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $lockerDocument['LockerDocument']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Member Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $lockerDocument['LockerDocument']['member_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Folder Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $lockerDocument['LockerDocument']['folder_id']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit LockerDocument', true), array('action'=>'edit', $lockerDocument['LockerDocument']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete LockerDocument', true), array('action'=>'delete', $lockerDocument['LockerDocument']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $lockerDocument['LockerDocument']['id'])); ?> </li>
		<li><?php echo $html->link(__('List LockerDocuments', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New LockerDocument', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
