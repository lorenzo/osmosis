<?php
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>
		Osmosis 2: e-learning innovation - 
		<?php echo $title_for_layout;?>
	</title>

	<?php echo $html->charset();?>

	<link rel="icon" href="<?php echo $this->webroot;?>favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="<?php echo $this->webroot;?>favicon.ico" type="image/x-icon" />
	<script type="text/javascript" src="<?php echo $html->url('/scorm/scos/api.js'); ?>" ></script>
	<?php echo $html->css('cake.generic');?>
	<?php echo $javascript->codeBlock('var webroot = "' . $this->webroot .'"'); ?>
	<?php echo $scripts_for_layout;?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo $html->link('Osmosis 2: e-learning innovation', '/');?></h1>
		</div>
		<div id="content">
			<?php
				if ($session->check('Message.flash')):
						$session->flash();
				endif;
			?>

			<?php echo $content_for_layout;?>

		</div>
		<div id="footer">
			<?php echo $html->link(
							$html->image('cake.power.png', array('alt'=>"CakePHP: the rapid development php framework", 'border'=>"0")),
							'http://www.cakephp.org/',
							array('target'=>'_new'), null, false
						);
			?>
		</div>
	</div>
	<?php echo $cakeDebug?>
</body>
</html>
