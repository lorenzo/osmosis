<div class="scorm">
<?php echo $form->create('Scorm', array('type'=>'file','url' => array('course_id' => $course_id)));?>
	<fieldset>
 		<legend><?php __('Add');?> <?php __('Scorm');?></legend>
 		<p>
			<?php
				__('Select the zip file');
			?>
		</p>
	<?php
		echo $form->input('course_id',array('type' => 'hidden', 'value' => $course_id));
		echo $form->input('name', array('label' =>  __('Name', true)));
		echo $form->input('file_name', array('type' => 'file'), array('label' =>  __('File Name', true)));
		echo $form->input('description', array('label' =>  __('Description', true)));
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>