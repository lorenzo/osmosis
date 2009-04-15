<?php
	if ($Osmosis['active_member']) :
?>

<div id="side-content" class="small">
	<ul id="conectivism">
		<li class="classes">
			<?php
				echo $html->link(__('Classes', true), array('plugin' => '', 'controller' => 'courses', 'action' => 'index'));
			?>
		</li>
		<li class="messages">
			<?php
				echo $html->link(
					__('Messages', true),
					array('plugin' => '', 'controller' => 'dashboards', 'action' => 'messages')
				);
			?>
		</li>
		<li class="conections">
			<?php
				echo $html->link(
					__('Connections', true),
					array('plugin' => '', 'controller' => 'dashboards', 'action' => 'connections')
				);
			?>
		</li>
	</ul>
</div>
<?php
	endif;
?>