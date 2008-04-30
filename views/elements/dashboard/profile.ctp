<div id="profile" class="boxed dashboard-element">
	<strong class="title"><?php __('Profile'); ?></strong>
	<dl>
		<dt><?php __('Full Name:')?></dt>
		<dd><?php echo $user['full_name'] ?></dd>
	</dl>
	<dl class="altrow">
		<dt><?php __('Email:')?></dt>
		<dd><?php echo $user['email'] ?></dd>
	</dl>
	<dl>
		<dt><?php __('Phone:')?></dt>
		<dd><?php echo $user['phone'] ?></dd>
	</dl>
	<dl class="altrow">
		<dt><?php __('Country:')?></dt>
		<dd><?php echo $user['country'] ?></dd>
	</dl>
	<dl>
		<dt><?php __('Age:')?></dt>
		<dd><?php echo $user['age'] ?></dd>
	</dl>
	<dl class="altrow">
		<dt><?php __('Sex:')?></dt>
		<dd><?php echo $user['sex'] ?></dd>	
	</dl>
	<p>
		<?php
			echo $html->link(__('Modify your profile', true), array('controller' => 'members', 'action' => 'edit', $user['id']));
		?>
	</p>
</div>