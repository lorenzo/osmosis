<div class="plugins index">
<h1><?php __('Plugins'); ?></h1>

<?php
	if(!empty($plugins)) :
?>
	<h2><?php __('Installed'); ?></h2>
	<ul class="dashboard-elements">
		<?php
			foreach($plugins as $plugin) :
				echo $this->element('plugin_box', compact('plugin'));
				unset($inServer[$plugin['Plugin']['name']]);
			endforeach;
		?>
	</ul>
<?php
	endif;
	if(!empty($inServer)) :
?>
	<h2 style="clear:both"><?php __('Not Installed');?></h2>
	<ul class="dashboard-elements">
		<?php
			foreach ($inServer as $key => $plugin) :
				$plugin['name'] = $key;
				$plugin = array('Plugin' => $plugin);
				echo $this->element('plugin_box', compact('plugin', 'key'));
			endforeach;
		?>
	</ul>
<?php
	endif;
?>

</div>