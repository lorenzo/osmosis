<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
	<title><?php echo $title_for_layout;?></title>
</head>
<body>
	<?php echo $simpleHtmlDom->globalStylesToAttibutes($content_for_layout);?>
	<p style="border-top:#ccc 1px dashed;text-align:right;padding:10px;margin-top:20px;">
		<?php
			__('Ósmosis is Opensource');
		?>
	</p>
</body>
</html>