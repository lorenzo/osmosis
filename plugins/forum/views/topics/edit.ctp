<div class="topics form">
<?php echo $form->create('Topic');?>
	<fieldset>
 		<legend><?php __('Edit Topic');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('description');
	?>
	<div class="checkbox">
	<?php
		echo $form->input(
			'close',
			array(
				'type' => 'checkbox',
				'label' => __('Lock this topic', true),
				'after' => '<span class="help">'.  __('(Nobody will be able to create more discussions on this topic)', true) . '</span>'
			)
		);
	?>
	</div>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>