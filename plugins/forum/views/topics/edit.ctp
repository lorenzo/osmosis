<div class="topics form">
<?php echo $form->create('Topic');?>
	<fieldset>
 		<legend><?php __d('forum','Edit Topic');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name', array('size' => '30'));
		echo $form->input('description', array('size' => '60'));
	?>
	<div class="checkbox">
	<?php
		echo $form->input(
			'close',
			array(
				'type' => 'checkbox',
				'label' => __d('forum','Lock this topic', true),
				'after' => '<span class="help">'.  __d('forum','(Nobody will be able to create more discussions on this topic)', true) . '</span>'
			)
		);
	?>
	</div>
	</fieldset>
<?php echo $form->end(__d('forum','Submit', true));?>
</div>