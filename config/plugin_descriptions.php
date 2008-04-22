<?php
$configure =& Configure::getInstance();
$paths =  $configure->pluginPaths;
$plugins = $configure->listObjects('plugin');
$search = array();
$config = array();

foreach ($paths as $key => $path) {
	foreach ($plugins as $plugin) {
		$search[] = $path. Inflector::underscore($plugin) . DS . 'config';
	}
}

foreach ($search as $path) {
	$file = $path . DS . 'description.php';
	if (is_file($file))
		include $file;
}


?>