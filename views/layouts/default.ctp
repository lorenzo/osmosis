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
			<div id="summary">
				<?php
					echo $this->renderElement('layout/conectivism');
				?>
				<div id="course-data">
					<div class="course">
						<h1>Fundamentos de JLO</h1>
						<p class="course-description">Conozca por qué...</p>
						<ul class="professors">
							<li>
								<div id="hcard-José-Lorenzo-Rodríguez" class="vcard">
									<a class="url fn n" href="http://joselorenzo.com.ve/">  <span class="given-name">José</span>
										<span class="additional-name">Lorenzo</span>
										<span class="family-name">Rodríguez</span>
									</a><br />
									<a class="email" href="mailto:jose.zap@gmail.com">jose.zap@gmail.com</a><br />
									<div class="tel">555-555555</div>
								</div>
							</li>
							<li>
								<div id="hcard-María-Grabriela-Días" class="vcard">
									<span class="fn n">
										<span class="given-name">Ana</span>
										<span class="additional-name">Gabriela</span>
										<span class="family-name">Días</span>
									</span><br />
									<a class="email" href="mailto:mabriela@gamil.com">mabriela@gamil.com</a><br />
									<span class="office">Mon-333</span>
								</div>
							</li>						
						</ul>
					</div>
				</div>
				<div id="more-courses">
					<?php echo $this->element('layout/user_courses',array('courses' => $Osmosis['courseList'])) ?>
				</div>
			</div>
			<div id="tools">
				<strong><?php echo (isset($layoutToolbarName)) ?  $layoutToolbarName : __('Tools',true) ?></strong>
					<?php echo $placeholder->renderToolBar(); ?>
			</div>
			<div id="main-content">
				<div id="side-content" class="small">
					<!--Insert here placehloders for side-content-->
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