<div class="courses">
	<strong><?php __('My Courses'); ?></strong>
<?php
 if (!empty($courses)) :
?>
	<ul>
	<?php foreach ($courses as $course) : ?>
		<?php $title = '<span class="code">['.$course['Course']['code'].']</span> '.$course['Course']['name']?>
		<li><?php echo $html->link($title, array('controller' => 'courses', 'action' => 'view', 'id' => $course['Course']['id']),null,null,false)?><li>
	<?php endforeach;?>
	</ul>
<!-- <div class= "course-info">
	<?php //debug($course); ?>
	
</div> -->
<?php
else :
?>
	<p><?php __('You aren\'t enrolled in any course.'); ?></p>
<?php
endif;
?>
</div>