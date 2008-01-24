<div class="members">
<h2><?php __('Members');?></h2>
<p>
<?php
$i = 0;
foreach ($members as $member):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<dl<?php echo $class;?>>
	<dt><?php __('Institution Id') ?></dt>
		<dd>
			<?php echo $member['Member']['institution_id'] ?>
		</dd>
	<dt class="altrow"><?php __('Full Name') ?></dt>
		<dd>
			<?php echo $member['Member']['full_name'] ?>
		</dd>
	<dt><?php __('Email') ?></dt>
		<dd>
			<?php echo $member['Member']['email'] ?>
		</dd>
	<dt><?php __('Role') ?></dt>
		<dd>
			<?php echo $html->link(__($member['Role']['id'], true), array('controller'=> 'roles', 'action'=>'view', $member['Role']['id'])); ?>
		</dd>
	<dt>Actions</dt>
		<dd class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $member['Member']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $member['Member']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $member['Member']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $member['Member']['id'])); ?>
		</dd>
	</dl>
<?php endforeach; ?>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('Member', true)), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Roles', true)), array('controller'=> 'roles', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s',  true), __('Role', true)), array('controller'=> 'roles', 'action'=>'add')); ?> </li>
	</ul>
</div>
