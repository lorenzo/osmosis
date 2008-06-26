<?php
	header('Content-Type: text/xml');
	Configure::write('debug', 0);
	e($xml->header());
	echo $content_for_layout;
?>