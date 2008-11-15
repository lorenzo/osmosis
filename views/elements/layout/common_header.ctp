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
<?php
	$webroot = $html->url('/');
	$active_course = isset($Osmosis['active_course']['id']) ? $Osmosis['active_course']['id'] : '';
	$js = <<<globaljs
		var webroot = '$webroot';
		var active_course = '$active_course';
globaljs;
	echo $javascript->codeBlock($js);
?> 
<?php echo $javascript->link('jquery/jquery'); ?> 
<?php echo $javascript->link('jquery/plugins/jquery.flydom'); ?> 
<?php echo $html->css('jquery.osmosis-selector'); ?> 
<?php echo $javascript->link('jquery/plugins/jquery.osmosis-selector'); ?>
<?php echo $javascript->link('jquery/plugins/jquery.bgiframe.min'); ?> 
<?php echo $javascript->link('jquery/plugins/jquery.autocomplete'); ?> 
<?php echo $javascript->link('jquery/plugins/jquery.fieldselection'); ?> 
<?php echo $javascript->link('osmosis/ui'); ?> 