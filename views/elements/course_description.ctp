<div class="content">	
	<h1><?php echo $course['Course']['name']; ?></h1>
	<p class="course-description"><?php echo $course['Course']['description']; ?></p>
	<?php
		if (empty($professors)) :
			echo '<p>' . __('No professors, this must be your lucky day!', true) . '</p>';
		else :
	?>
	<ul class="professors">
		<?php
			// debug($professors);
		?>
		<!-- <li>
			<div id="hcard-José-Lorenzo-Rodríguez" class="vcard">
				<a class="url fn n" href="http://joselorenzo.com.ve/">  <span class="given-name">José</span>
					<span class="additional-name">Lorenzo</span>
					<span class="family-name">Rodríguez</span>
				</a><br />
				<a class="email" href="mailto:jose.zap@gmail.com">jose.zap@gmail.com</a><br />
				<div class="tel">555-555555</div>
			</div>
		</li>
		<li>
			<div id="hcard-María-Grabriela-Días" class="vcard">
				<span class="fn n">
					<span class="given-name">Ana</span>
					<span class="additional-name">Gabriela</span>
					<span class="family-name">Días</span>
				</span><br />
				<a class="email" href="mailto:mabriela@gamil.com">mabriela@gamil.com</a><br />
				<span class="office">Mon-333</span>
			</div>
		</li>						 -->
	</ul>
	<?php
		endif;
	?>
</div>
