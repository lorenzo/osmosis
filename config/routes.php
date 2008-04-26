<?php
	Router::parseExtensions('js');
	Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
	Router::connect('/algo', array('controller'=> 'wikis', 'action' => 'index', 'plugin' => 'wiki'));
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
	Router::connect('/tests', array('controller' => 'tests', 'action' => 'index'));
?>
