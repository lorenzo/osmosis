<div class="courses abstract">
	<strong class="title"><?php __('My Courses'); ?></strong>
<?php
 if (!empty($courses)) :
?>
	<ul>
	<?php foreach ($courses as $course) : ?>
		<li>
			<?php
				echo $html->link(
					$title = '<span class="code">['.$course['Course']['code'].']</span> '.$course['Course']['name'],
					array(
						'controller' => 'courses',
						'action' => 'view',
						'id' => $course['Course']['id']
					),null,null,false
				)
			?>
		</li>
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