<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<?php echo $html->charset();?>
	<?php echo $html->css('default/layout'); ?> 
	<?php echo $html->css('default/styles'); ?> 
	<?php echo $html->css('default/forms'); ?> 
	<?php echo $html->css('default/tables'); ?> 
	<?php echo $html->css('default/admin'); ?> 
	<!--[if lte IE 7]>
		<?php echo $html->css('default/ie_layout'); ?> 
	<![endif]-->
	<!--[if IE 6]>
		<?php echo $html->css('default/ie6_layout'); ?> 
	<![endif]-->
	<?php if(Configure::read()>0) echo $html->css('debug');?> 
	<?php echo $javascript->codeBlock('var webroot = "' . $html->url('/') .'"'); ?> 
	<?php echo $scripts_for_layout; ?> 
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
			<div id="summary" class="growing">
				<div id="side-content" class="small">
					<ul id="conectivism">
						<li class="classes">
							<?php
								echo $html->link(__('Courses', true), array('controller' => 'courses', 'action' => 'index'));
							?>
						</li>
						<li>
							<?php
								echo $html->link(__('Departments', true), array('controller' => 'departments', 'action' => 'index'));
							?>
						</li>
						<li>
							<?php
								echo $html->link(__('Members', true), array('controller' => 'members', 'action' => 'index'));
							?>
						</li>
						<li>
							<?php
								echo $html->link(__('Plugins', true), array('controller' => 'plugins', 'action' => 'index'));
							?>
						</li>
					</ul>
				</div>
				<div id="admin-main">
					<div id="course-data">
						<div class="course">
							<?php echo $content_for_layout; ?>
						</div>
					</div>
					<div id="more-courses">
						<div class="courses">
							<strong>???</strong>
							<ul>
								<li><a href="#"><span class="code">[QK-1111]</span> Un curso</a></li>
								<li><a href="#"><span class="code">[CI-1111]</span> Otro...</a></li>
								<li><a href="#"><span class="code">[CI-1111]</span> Otro...</a></li>
								<li><a href="#"><span class="code">[CI-1111]</span> Otro...</a></li>
								<li><a href="#"><span class="code">[CI-1111]</span> Otro...</a></li>
								<li><a href="#"><span class="code">[CI-1111]</span> Otro...</a></li>
							</ul>
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