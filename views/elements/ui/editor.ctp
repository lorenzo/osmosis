<?php
if (!isset($options)) {
	$options = array();
}
echo $javascript->link('tiny_mce/tiny_mce',null,null,false);
$this->_loadHelpers($this->helpers,array('TinyMce'));
$this->TinyMce = $this->helpers['TinyMce'];
$widget = $this->TinyMce->widget($options);
if (!isset($enclose) || $enclose == true) {
	echo $javascript->codeBlock($widget);
} else
	echo $widget;
?>
