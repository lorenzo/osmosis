<?php
$mode = (isset($mode)) ? $mode : 'textareas';
$theme = (isset($theme)) ? $theme : 'advanced';
$plugins = array(
	'safari',
	'table',
	'preview',
	'paste',
	'xhtmlxtras',
	'youtube',
	'media',
	'inlinepopups'
	);

$row1 = array(
	'bold',
	'italic',
	'underline','|',
	'justifyleft',
	'justifycenter',
	'justifyright',
	'justifyfull','|',
	'formatselect',
	);

$row2 = array(
	'cut',
	'copy',
	'paste',
	'search',
	'replace','|',
	'bullist',
	'numlist','|',
	'outdent',
	'indent','|',
	'undo',
	'redo','|',
	'link',
	'unlink',
	'image','|',
	'preview',
	'code',
	);
$row3 = array(
	'tablecontrols','|',
	'hr',
	'cite',
	'abbr',
	'acronym',
	'removeformat','|',
	'sub',
	'sup','|',
	'charmap',
	'youtube',
	'media');
	
$tiny = 'tinyMCE.init({';
$tiny .= 'mode : "'. $mode .'",';
$tiny .= 'theme : "'. $theme .'",';
$tiny .= 'plugins : "'. implode(',',$plugins) .'",';
if($theme == 'advanced') {
	$tiny .= 'theme_advanced_toolbar_location : "top",';
	$tiny .= 'theme_advanced_toolbar_align : "left",';
	$tiny .= 'theme_advanced_statusbar_location : "bottom",';
	$tiny .= 'theme_advanced_resizing : true,';
	$tiny .= 'theme_advanced_buttons1 : "'. implode(',',$row1) .'",';
	$tiny .= 'theme_advanced_buttons2 : "'. implode(',',$row2) .'",';
	$tiny .= 'theme_advanced_buttons3 : "'.implode(',',$row3) .'",';
}
$tiny .= 'button_tile_map : true,';
$tiny .= 'entity_encoding : "raw",';
$tiny .= 'verify_html : false,';
//$tiny .= 'content_css : "'.$html->webroot((COMPRESS_CSS ? 'c' : '') . CSS_URL . 'cake.generic.css').'",';

$tiny .= '});';
if(isset($javascript))
	echo $javascript->codeBlock($tiny);
?>