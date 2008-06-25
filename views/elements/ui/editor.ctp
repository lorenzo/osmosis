<?php echo $javascript->link('tiny_mce/tiny_mce',null,null,false); ?>
<?php
$width = 700;
$height = 300;
if (isset($settings['width']))
	$width = $settings['width'];
	
if (isset($settings['height']))
	$height = $settings['height'];
?>
<script language="javascript" type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		skin : "osmosis",
		plugins : "safari,table,save,inlinepopups,preview,media,contextmenu,paste,fullscreen,noneditable,visualchars,xhtmlxtras,noneditable,latex",
		theme_advanced_buttons1: "save,preview,|,cut,copy,paste,pasteword,|,undo,redo,|,link,unlink,|,image,media,|,removeformat,code,fullscreen",
		theme_advanced_buttons2 : "bold,italic,underline,|,justifyleft,justifyfull,|,bullist,numlist,|,blockquote,formatselect,|,charmap,latex",
		theme_advanced_buttons3 : "",
		theme_advanced_toolbar_location : "bottom",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		media_types : 'flash',
		convert_urls: false,
		width: <?php echo $width?>,
		height: <?php echo $height?>
	});
</script>
