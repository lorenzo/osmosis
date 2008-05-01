<div id="top">
	<ul>
		<li><a href="#">Buscar</a></li>
		<li><a href="#">Ayuda</a></li>
		<li><?php echo $html->link(__('Logout', true), array('plugin' => null,'controller' => 'members', 'action' => 'logout', 'admin' => false)); ?></li>
	</ul>
</div>