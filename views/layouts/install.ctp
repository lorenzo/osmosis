<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<?php echo $html->charset();?> 
	<?php echo $html->css('default/layout'); ?> 
	<?php echo $html->css('default/styles'); ?>
	<?php echo $html->css('default/install'); ?>
	<?php echo $html->css('default/forms'); ?>
	<title>Ósmosis :: <?php echo $title_for_layout;?></title> 
</head>
<body id="install">
	<?php
		echo $this->element('layout/logo');
	?>
	<div id="content">
		<div class="contentcolumn">
			<div id="top"></div>
			<div id="upper-content" class="login">
				<div id="wrap">
					<div class="main">
						<div class="content">
							<?php
								if ($session->check('Message.flash')) {
									$session->flash();
								}
								echo $content_for_layout;
							?>
						</div>
					</div>
					</div>
				</div>
				<div id="main-content">
					<div id="footer">
						<p>Ósmosis 2 is Open Source</p>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
