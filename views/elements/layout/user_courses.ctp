<div class="courses">
	<strong><?php __('My Courses'); ?></strong>
	<ul>
	<?php foreach ($courses as $course) : ?>
		<?php $title = '<span class="code">['.$course['Course']['code'].']</span> '.$course['Course']['name']?>
		<li><?php echo $html->link($title, array('controller' => 'courses', 'action' => 'view', 'id' => $course['Course']['id']),null,null,false)?><li>
	<?php endforeach;?>
	</ul>
</div>