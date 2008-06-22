<div class="content">	
	<h1><?php echo $course['Course']['name']; ?></h1>
	<div class="course-data">
		<p class="course-description"><?php echo $filter->filter($course['Course']['description']); ?></p>
		<?php
			if (!isset($this->viewVars['Osmosis']['active_course']['professors']) ||
			 	empty($this->viewVars['Osmosis']['active_course']['professors'])) :
				echo '<p>' . __('There are no professors for this course', true) . '</p>';
			else :
				echo $this->element(
					'professor_list',
					array('professors' => $this->viewVars['Osmosis']['active_course']['professors'])
				);
			endif;
		?>
	</div>
</div>