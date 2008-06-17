<div class="content">	
	<h1><?php echo $course['Course']['name']; ?></h1>
	<div class="course-data">
		<p class="course-description"><?php echo $course['Course']['description']; ?></p>
		<?php
			if (!isset($this->viewVars['Osmosis']['active_course']['professors']) ||
			 	empty($this->viewVars['Osmosis']['active_course']['professors'])) :
				echo '<p>' . __('No professors, this must be your lucky day!', true) . '</p>';
			else :
				echo $this->element(
					'professor_list',
					array('professors' => $this->viewVars['Osmosis']['active_course']['professors'])
				);
			endif;
		?>
	</div>
</div>
