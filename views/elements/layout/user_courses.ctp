<div class="courses abstract">
	<strong class="title"><?php __('My Courses'); ?></strong>
<?php
 if (isset($Osmosis['courseList'])) :
?>
	<ul>
	<?php foreach ($Osmosis['courseList'] as $course) : ?>
		<li>
			<?php
				echo $html->link(
					$title = '<span class="code">['.$course['Course']['code'].']</span> '.$course['Course']['name'],
					array(
						'plugin' => '',
						'controller' => 'courses',
						'action' => 'view',
						'id' => $course['Course']['id']
					),null,null,false
				)
			?>
		</li>
	<?php endforeach;?>
	</ul>
<?php
else :
?>
	<p><?php __('You aren\'t enrolled in any course.'); ?></p>
<?php
endif;
	echo $html->link(__('Find a Course to enroll', true), array('controller' => 'departments', 'action' => 'index'));
?>
</div>