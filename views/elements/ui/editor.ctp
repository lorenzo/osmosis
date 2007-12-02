<?php
$mode = (isset($mode)) ? $mode : 'textareas';
$theme = (isset($theme)) ? $theme : 'advanced';
$plugins = array(
	'safari','table','insertdatetime','preview','paste','xhtmlxtras'
	);
$row2 = array('cut','copy','paste','pastetext','pasteword','|','search','replace','|','bullist','numlist','|','outdent','indent','|','undo','redo','|','link','unlink','anchor','image','cleanup','help','code','|','insertdate','inserttime','preview','|','forecolor','backcolor');
$row3 = array('tablecontrols','|','hr','cite','abbr','acronym','removeformat','|','sub','sup','|','charmap');
$tiny = 'tinyMCE.init({';
$tiny .= 'mode : "'. $mode .'",';
$tiny .= 'theme : "'. $theme .'",';
$tiny .= 'plugins : "'. implode(',',$plugins) .'",';
if($theme == 'advanced') {
	$tiny .= 'theme_advanced_toolbar_location : "top",';
	$tiny .= 'theme_advanced_toolbar_align : "left",';
	$tiny .= 'theme_advanced_statusbar_location : "bottom",';
	$tiny .= 'theme_advanced_resizing : true,';
	$tiny .= 'theme_advanced_buttons2 : "'. implode(',',$row2) .'",';
	$tiny .= 'theme_advanced_buttons3 : "'.implode(',',$row3) .'",';
}
$tiny .= 'button_tile_map : true,';
$tiny .= 'entity_encoding : "raw",';
$tiny .= 'verify_html : false,';
$tiny .= '});';
if(isset($javascript))
	echo $javascript->codeBlock($tiny);
?>