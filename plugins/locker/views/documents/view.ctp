<div class="documents view">
<h2><?php  __('Document');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $document['Document']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $document['Document']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Locker'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($document['Locker']['id'], array('controller'=> 'lockers', 'action'=>'view', $document['Locker']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Document', true), array('action'=>'edit', $document['Document']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Document', true), array('action'=>'delete', $document['Document']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $document['Document']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Documents', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Document', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Lockers', true), array('controller'=> 'lockers', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Locker', true), array('controller'=> 'lockers', 'action'=>'add')); ?> </li>
	</ul>
</div>
