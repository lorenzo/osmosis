<div id="top">
	<ul>
		<!-- <li><a href="#">Buscar</a></li> -->
		<!-- <li><a href="#">Ayuda</a></li> -->
		<?php
			if ($Osmosis['active_member']['admin']) :
		?>
		<li>
			<?php
				echo $html->link(__('Admin', true), array('controller' => 'dashboards', 'action' => 'dashboard', 'admin' => true, 'plugin' => null));
			?>
		</li>
		<?php
			endif;
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