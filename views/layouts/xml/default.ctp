<?php
	header('Content-Type: text/xml');
	e($xml->header());
	Configure::write('debug',0);
	echo $content_for_layout;
?>