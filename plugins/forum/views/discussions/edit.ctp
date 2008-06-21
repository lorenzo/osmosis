<div class="discussions form">
<?php echo $form->create('Discussion',array('url' => array('topic_id' => $this->data['Discussion']['topic_id'])));?>
	<fieldset>
 		<legend><?php __('Edit Discussion');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('title');
		echo $form->input('content');
	?>
	<div class="checkbox">
	<?php
		echo $form->input(
			'close',
			array(
				'type' => 'checkbox',
				'label' => __('Lock this discussion', true),
				'after' => '<span class="help">'.  __('(Nobody will be able to reply anymore. Cannot be undone.)', true) . '</span>'
			)
		);
	?>
	<?php
		echo $form->input('sticky', array('label' => __('Keep this discussion on top', true)));
	?>
	</div>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<?php
	echo $this->renderElement('ui/editor');
?>