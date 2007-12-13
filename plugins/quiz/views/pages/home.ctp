<h2>Sweet, "" got Baked by CakePHP!</h2>

<?php
if(Configure::read() > 0):
	Debugger::checkSessionKey();
endif;
?>
<p>
	<span class="notice">
		<?php
			if (is_writable(TMP)):
				__('Your tmp directory is writable.');
			else:
				__('Your tmp directory is NOT writable.');
			endif;
		?>
	</span>
</p>
<p>
	<span class="notice">
		<?php
			if (Cache::isInitialized()):
				__('Your cache is set up and initialized properly.');
				$settings = Cache::settings();
				echo '<p>';
				echo sprintf(__('%s is being used to cache, to change this edit config'.DS.'core.php ', true), $settings['engine'] . 'Engine');
				echo '</p>';

				echo 'Settings: <ul>';
				foreach ($settings as $name => $value):
					echo '<li>' . $name . ': ' . $value . '</li>';
				endforeach;
				echo '</ul>';

			else:
				__('Your cache is NOT working.');
				echo '<br />';
				if (is_writable(TMP . 'cache')):
					__('Edit: config'.DS.'core.php to insure you have the newset version of this file and the variable $cakeCache set properly');
				else:
					__('Your cache directory is not writable');
				endif;
			endif;
		?>
	</span>
</p>
<p>
	<span class="notice">
		<?php
			$filePresent = null;
			if (file_exists(CONFIGS.'database.php')):
				__('Your database configuration file is present.');
				$filePresent = true;
			else:
				__('Your database configuration file is NOT present.');
				echo '<br/>';
				__('Rename config'.DS.'database.php.default to config'.DS.'database.php');
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
			if ($connected->isConnected()):
		 		__('Cake is able to connect to the database.');
			else:
				__('Cake is NOT able to connect to the database.');
			endif;
		?>
	</span>
</p>
<?php endif;?>
<h3><?php __('Editing this Page') ?></h3>
<p>
<?php __('To change the content of this page, edit: /home/joaquin/sitios/osmosis/plugins/quizzes/pages/home.ctp.<br />
To change its layout, edit: /home/joaquin/sitios/osmosis/plugins/quizzes/layouts/default.ctp.<br />
You can also add some CSS styles for your pages at: /home/joaquin/sitios/osmosis/plugins/quizzes/webroot/css.
') ?></p>
