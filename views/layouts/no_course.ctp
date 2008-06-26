<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<?php
		echo $this->element('layout/common_header');
	?> 
	<!-- Begin plugins header -->
	<?php echo $placeholder->render('head'); ?> 
	<!-- End plugins header --> 
	<?php echo $scripts_for_layout; ?> 
	<title>Ósmosis - NoCourse :: <?php echo $title_for_layout;?></title> 
</head>
<body>
	<?php
		echo $this->element('layout/logo');
	?>
	<div id="content">
		<div class="contentcolumn">
			<?php
				echo $this->element('layout/top_nav');
			?>
			<div id="upper-content">
				<div id="wrap">
					<?php
						echo $this->element('layout/conectivism');
					?>
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
					<div id="more-courses">
						<?php
							if (isset($Osmosis['courseList'])) {
								echo $this->element('layout/user_courses',array('courses' => $Osmosis['courseList']));
							}
						?>
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