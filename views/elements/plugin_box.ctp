<li class="boxed dashboard-element">
	<dl class="plugin">
		<dt>
		<strong class="title">
			<?php
				
				echo (isset($plugin['Plugin']['title'])) ?
					$plugin['Plugin']['title'] : Inflector::humanize($plugin['Plugin']['name']);
			?>
		</strong>
		</dt>				
		<dd>
			<p>
				<?php
					if (!empty($plugin['Plugin']['description'])) {
						echo $plugin['Plugin']['description'];
					} else {
						__('This plugin has no description.');
					}
				?>
			</p>				
			<?php if (isset($plugin['Plugin']['author'])) :?>
				<p class="author">
					<strong><?php echo __('Author')?> </strong>
					<span><?php echo $plugin['Plugin']['author'] ?></span>
				</p>
			<?php endif;?>
		</dd>
	</dl>
	<p class="go action">
<?php
	if (isset($plugin['Plugin']['id'])) {
		echo $html->link(
			__('Uninstall',true),
			array('controller' => 'plugins' ,'action' => 'uninstall', Inflector::underscore($plugin['Plugin']['id']))
		); 
	 	if (!$plugin['Plugin']['active']) {
			echo $html->link(
				__('Activate',true),
				array('controller' => 'plugins' ,'action' => 'activate', Inflector::underscore($plugin['Plugin']['id']))
			);
 		} else {
			echo $html->link(
				__('Deactivate',true),
				array('controller' => 'plugins' ,'action' => 'deactivate', Inflector::underscore($plugin['Plugin']['id']))
			);
		}
	} else {
		echo $html->link(
			__('Install',true),
			array('controller' => 'plugins' ,'action' => 'install', Inflector::underscore($key))
		);
	}
?>
	</p>
</li>