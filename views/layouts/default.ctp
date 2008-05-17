<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<?php echo $html->charset();?>
	<?php echo $html->css('default/layout'); ?> 
	<?php echo $html->css('default/styles'); ?> 
	<?php echo $html->css('default/forms'); ?> 
	<?php echo $html->css('default/tables'); ?> 
	<!--[if lte IE 7]>
		<?php echo $html->css('default/ie_layout'); ?> 
	<![endif]-->
	<!--[if IE 6]>
		<?php echo $html->css('default/ie6_layout'); ?> 
	<![endif]-->
	<?php if(Configure::read()>0) echo $html->css('debug');?> 
	<?php echo $javascript->codeBlock('var webroot = "' . $html->url('/') .'"'); ?> 
	<?php echo $scripts_for_layout; ?> 
	<?php echo $placeholder->render('head'); ?>
	<title>Ósmosis :: <?php echo $title_for_layout;?></title> 
</head>
<body>
	<?php
		echo $this->renderElement('layout/logo');
	?>
	<div id="content">
		<div class="contentcolumn">
			<?php
				echo $this->renderElement('layout/top_nav');
			?>
			<div id="upper-content" class="summary">
				<div id="wrap">
					<?php
						echo $this->renderElement('layout/conectivism');
					?>
					<div id="main">
						<?php
							echo $this->renderElement('course_description');
						?>
					</div>
					<div id="more-courses">
					<?php
						if (isset($Osmosis['courseList'])) {
							echo $this->element('layout/user_courses',array('courses' => $Osmosis['courseList']));
						}
					?>
				</div>
				</div>
			</div>
			<div id="tools">
				<strong><?php echo (isset($layoutToolbarName)) ?  $layoutToolbarName : __('Tools',true) ?></strong>
					<?php echo $placeholder->renderToolBar(); ?>
			</div>
			<div id="main-content">
				<div id="side-content" class="small">
					<?php echo $placeholder->render('course_sidebar'); ?>
				</div>
				<div id="main">
					<?php
						if ($session->check('Message.flash')) {
							$session->flash();
						}
					?>
					<?php echo $content_for_layout; ?>
				</div>
				<div id="footer">
					<p>Ósmosis 2 is Open Source</p>
				</div>
			</div>
		</div>
	</div>
</body>
</html>