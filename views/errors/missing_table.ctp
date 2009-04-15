<?php
$this->layout = 'install';
?>
<h1><?php __('There seems to be a missing table in Ósmosis database'); ?></h1>
<p>
	<?php
		echo sprintf(__('Database table %1$s for model %2$s was not found.', true),"<em>". $table ."</em>",  "<em>". $model ."</em>");
	?>
</p>
<p>
	<?php
		echo __('Maybe Ósmosis has not been installed:', true) . ' ' .
			$html->link('Install Ósmosis', array('controller' => 'installer', 'action' => 'index', 'admin' => false, 'plugin' => null));
	?>
</p>