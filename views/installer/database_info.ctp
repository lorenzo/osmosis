<h1><?php __('Installation'); ?></h1>
<h2>
	<?php printf(__('Step', true) . ' %d: %s', $current_step_position, $current_step_name); ?>
</h2>
<?php
if (!isset($dbFileNotWritable)) {
	echo $form->create('Installer', array('url' => array('controller' => 'installer', 'action' => 'index', 'database_info')));
?>
<p>
	<?php __('Please write the database configuration.'); ?>
	<strong><?php __('The selected database must exist and be empty.'); ?></strong>
</p>
<p>
	<?php
		if ($configFileExists) {
			__('The configuration file exists');
			echo ' ' . $html->link(
				__('you can skip this step', true),
				array(
					'controller'	=> 'installer',
					'action'		=> 'index',
					'load_database'
				)
			) . '.';
		}
	?>
</p>
	<fieldset>
 		<legend><?php echo sprintf(__('Configure database access'));?></legend>
	<?php
		echo $form->input('driver', array('label'=>__('Type', true)));
		echo $form->input('host', array('label'=> __('Host', true)));
	?>
	<div class="group">
		<strong><?php __('Database Access'); ?></strong>
		<?php
			echo $form->input('dbusername', array('label'=>__('Login', true)));
			echo $form->input('dbpassword', array('label'=>__('Password', true)));
		?>
	</div>
	<div class="group">
		<strong><?php __('Schema'); ?></strong>
		<?php
			echo $form->input('name', array('label'=>__('Name', true)));
			echo $form->input('prefix',
				array(
					'label'=> array(
						'text' => __('Prefix', true),
						'class' => 'small'
					),
					'class' => 'small'
				)
			);
			echo $form->input('port',
				array(
					'label'=> array(
						'text' => __('Port', true),
						'class' => 'small'
					),
					'class' => 'small'
				)
			);
		?>
	</div>
	</fieldset>
	<?php echo $form->end(__('Submit', true)); ?>
<?php
	} else {
?>
<p>
	<?php __('The database configuration file could not be written to the disk.'); ?>
</p>
<p>
	<?php printf(__('Create the file <strong>%s</strong> with the following content:', true),  $dbConfigFile); ?> <br/ >
	<pre><?php echo htmlentities($dbFileNotWritable); ?></pre>
</p>
<p class="submit">
	<?php
		echo $html->link(
			__('Continue when ready', true),
			array(
				'controller'	=> 'installer',
				'action'		=> 'index',
				'load_database'
			)
		);
	?>
</p>
<?php
	}
?>