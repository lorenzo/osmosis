<div class="scorm">
<?php echo $form->create('Scorm', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Add');?> <?php __('Scorm');?></legend>
 		<p>
			<?php
				__('Indique el archivo zip...');
			?>
		</p>
	<?php
		echo $form->input('course_id');
		echo $form->input('name', array('label' =>  __('Name', true)));
		echo $form->input('file_name', array('type' => 'file'), array('label' =>  __('File Name', true)));
		echo $form->input('description', array('label' =>  __('Description', true)));
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List', true).' '.__('Scorms', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List', true).' '.__('Scos', true), array('controller'=> 'scos', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Sco', true), array('controller'=> 'scos', 'action'=>'add')); ?> </li>
	</ul>
</div>
