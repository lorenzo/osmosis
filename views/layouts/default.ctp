<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<?php
		echo $this->element('layout/common_header');
	?>
	<?php echo $placeholder->render('head'); ?> 
	<title>Ósmosis - Default :: <?php echo $title_for_layout;?></title> 
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