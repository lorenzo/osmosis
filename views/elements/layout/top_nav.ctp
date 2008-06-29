<div id="top">
	<ul>
		<?php
			if ($Osmosis['active_member']['admin']) :
		?>
		<li>
			<?php
				echo $html->link(__('Admin Area', true), array('controller' => 'dashboards', 'action' => 'dashboard', 'admin' => true, 'plugin' => null));
			?>
		</li>
		<?php
			endif;
		?>
		<?php
			if (!empty($Osmosis['active_member'])) :
		?>
		<li>
			<?php
				echo $html->link(
					$Osmosis['active_member']['username'],
					array('plugin' => null, 'controller' => 'members', 'action' => 'view', 'admin' => false, $Osmosis['active_member']['id'])
				);
			?>
		</li>
		<?php
			endif
		?>
		<li>
			<?php
				if (!empty($Osmosis['active_member'])) {
					echo $html->link(
						__('Logout', true),
						array('plugin' => null, 'controller' => 'members', 'action' => 'logout', 'admin' => false)
					);
				} else  {
					echo $html->link(
						__('Login', true),
						array('plugin' => null, 'controller' => 'members', 'action' => 'login', 'admin' => false)
					);
				}
			?>
		</li>
	</ul>
</div>