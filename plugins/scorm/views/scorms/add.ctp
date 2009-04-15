<div class="scorm">
<?php echo $form->create('Scorm', array('type'=>'file','url' => array('course_id' => $course_id)));?>
	<fieldset>
 		<legend><?php __d('scorm','Add');?> <?php __('Scorm');?></legend>
 		<p>
			<?php
				__d('scorm','Select the zip file');
			?>
		</p>
	<?php
		echo $form->input('course_id',array('type' => 'hidden', 'value' => $course_id));
		echo $form->input('name', array('label' =>  __d('scorm','Name', true)));
		echo $form->input('file_name', array('type' => 'file'), array('label' =>  __d('scorm','File Name', true)));
		echo $form->input('description', array('label' =>  __d('scorm','Description', true)));
	?>
	</fieldset>
<?php echo $form->end(__d('scorm','Submit', true));?>
</div>