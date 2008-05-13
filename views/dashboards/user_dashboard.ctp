<div id="enroll">
	<?php
		echo $html->link(__('Find a Course to enroll', true), array('controller' => 'departments', 'action' => 'index'));
	?>
</div>
<?php
	if (empty($courses)) {
		echo '<p> ' . __('You are not enrolled in any course.', true) . '</p>	';
	}
?>