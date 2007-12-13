<div class="member">
<h2><?php  __('Member');?></h2>
	<dl>
		<dt class="altrow"><?php __('Id') ?></dt>
		<dd class="altrow">
			<?php echo $member['Member']['id'] ?>
			&nbsp;
		</dd>
		<dt><?php __('Institution Id') ?></dt>
		<dd>
			<?php echo $member['Member']['institution_id'] ?>
			&nbsp;
		</dd>
		<dt class="altrow"><?php __('Full Name') ?></dt>
		<dd class="altrow">
			<?php echo $member['Member']['full_name'] ?>
			&nbsp;
		</dd>
		<dt><?php __('Email') ?></dt>
		<dd>
			<?php echo $member['Member']['email'] ?>
			&nbsp;
		</dd>
		<dt class="altrow"><?php __('Phone') ?></dt>
		<dd class="altrow">
			<?php echo $member['Member']['phone'] ?>
			&nbsp;
		</dd>
		<dt><?php __('Country') ?></dt>
		<dd>
			<?php echo $member['Member']['country'] ?>
			&nbsp;
		</dd>
		<dt class="altrow"><?php __('City') ?></dt>
		<dd class="altrow">
			<?php echo $member['Member']['city'] ?>
			&nbsp;
		</dd>
		<dt><?php __('Age') ?></dt>
		<dd>
			<?php echo $member['Member']['age'] ?>
			&nbsp;
		</dd>
		<dt class="altrow"><?php __('Sex') ?></dt>
		<dd class="altrow">
			<?php echo $member['Member']['sex'] ?>
			&nbsp;
		</dd>
		<dt><?php __('Role') ?></dt>
		<dd>
			<?php echo $html->link(__($member['Role']['id'], true), array('controller'=> 'roles', 'action'=>'view', $member['Role']['id'])); ?>
			&nbsp;
		</dd>
		<dt class="altrow"><?php __('Username') ?></dt>
		<dd class="altrow">
			<?php echo $member['Member']['username'] ?>
			&nbsp;
		</dd>
		<dt><?php __('Password') ?></dt>
		<dd>
			<?php echo $member['Member']['password'] ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(sprintf(__('Edit %s', true), __('Member', true)), array('action'=>'edit', $member['Member']['id'])); ?> </li>
		<li><?php echo $html->link(sprintf(__('Delete %s', true), __('Member', true)), array('action'=>'delete', $member['Member']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $member['Member']['id'])); ?> </li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Members', true)), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('Member', true)), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Roles', true)), array('controller'=> 'roles', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('Role', true)), array('controller'=> 'roles', 'action'=>'add')); ?> </li>
	</ul>
</div>
