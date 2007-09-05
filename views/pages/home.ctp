<h2>Sweet, "Osmosis" got Baked by CakePHP!</h2>

<?php Debugger::checkSessionKey(); ?>
<p>
	<span class="notice">
		<?php
			__('Your tmp directory is ');
			if (is_writable(TMP)):
				__('writable.');
			else:
				__('NOT writable.');
			endif;
		?>
	</span>
</p>
<p>
	<span class="notice">
		<?php
			__('Your cache is ');
			if (Cache::isInitialized()):
				__('set up and initialized properly.');
				$settings = Cache::settings();
				echo '<p>' . $settings['class'];
				__(' is being used to cache, to change this edit config/core.php ');
				echo '</p>';

				echo 'Settings: <ul>';
				foreach ($settings as $name => $value):
					echo '<li>' . $name . ': ' . $value . '</li>';
				endforeach;
				echo '</ul>';

			else:
				__('NOT working.');
				echo '<br />';
				if (is_writable(TMP)):
					__('Edit: config/core.php to insure you have the newset version of this file and the variable $cakeCache set properly');
				endif;
			endif;
		?>
	</span>
</p>
<p>
	<span class="notice">
		<?php
			__('Your database configuration file is ');
			$filePresent = null;
			if (file_exists(CONFIGS.'database.php')):
				__('present.');
				$filePresent = true;
			else:
				__('NOT present.');
				echo '<br/>';
				__('Rename config/database.php.default to config/database.php');
			endif;
		?>
	</span>
</p>
<?php
if (!empty($filePresent)):
 	uses('model' . DS . 'connection_manager');
	$db = ConnectionManager::getInstance();
 	$connected = $db->getDataSource('default');
?>
<p>
	<span class="notice">
		<?php
			__('Cake');
			if ($connected->isConnected()):
		 		__(' is able to ');
			else:
				__(' is NOT able to ');
			endif;
			__('connect to the database.');
		?>
	</span>
</p>
<?php endif;?>
<h3>Editing this Page</h3>
<p>
To change the content of this page, edit: /Users/lorenzo/Documents/workspace/osmosis//views/pages/home.ctp.<br />
To change its layout, edit: /Users/lorenzo/Documents/workspace/osmosis//views/layouts/default.ctp.<br />
You can also add some CSS styles for your pages at: /Users/lorenzo/Documents/workspace/osmosis//webroot/css/.
</p>
