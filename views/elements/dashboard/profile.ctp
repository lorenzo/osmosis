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
		<dd><?php echo $user['country'] ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?php __('Age:')?></dt>
		<dd><?php echo $user['age'] ?></dd>
	</dl>
	<dl class="altrow">
		<dt><?php __('Sex:')?></dt>
		<dd><?php echo $user['sex'] ?></dd>	
	</dl>
	<p class="go">
		<?php
			$edit = false;
			if ($Osmosis['active_member']['id'] == $user['id']){
				$edit = true;
				$message = __('Modify your profile', true);
			}
			if ($Osmosis['active_member']['admin']) {
				$edit = true;
				$message = __('Modify this profile', true);
			}
			if ($edit)
				echo $html->link(
					$message,
					array('admin' => false, 'controller' => 'members', 'action' => 'edit', $user['id'])
				);
		?>
	</p>
</div>
<?php
	if (isset($connect)) :
?>
<div id="connect" class="boxed dashboard-element">
	<strong class="title"><?php __('Connect'); ?></strong>
	<ul>
		<?php
			echo $placeholder->render('profile_connect');
		?>
	</ul>
</div>
<?php
	endif;
?>