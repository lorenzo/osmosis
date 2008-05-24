<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<?php
		echo $this->element('layout/common_header');
	?> 
	<?php echo $placeholder->render('head'); ?> 
	<?php echo $html->css('default/admin'); ?> 
	<title>Ósmosis - Admin :: <?php echo $title_for_layout;?></title> 
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
					<div id="main">
						<div class="content">
							<?php echo $content_for_layout; ?>
						</div>
					</div>
					<div id="more-courses">
						<!-- <div class="courses">
							<strong>???</strong>
							<ul>
								<li><a href="#"><span class="code">[QK-1111]</span> Un curso</a></li>
								<li><a href="#"><span class="code">[CI-1111]</span> Otro...</a></li>
								<li><a href="#"><span class="code">[CI-1111]</span> Otro...</a></li>
								<li><a href="#"><span class="code">[CI-1111]</span> Otro...</a></li>
								<li><a href="#"><span class="code">[CI-1111]</span> Otro...</a></li>
								<li><a href="#"><span class="code">[CI-1111]</span> Otro...</a></li>
							</ul>
						</div> -->
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