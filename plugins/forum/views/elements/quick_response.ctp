<div class="responses form">
<?php echo $form->create('Response',array('url' => array('discussion_id' => $discussion_id)));?>
	<fieldset>
 		<legend><?php __('Reply');?></legend>
	<?php
		echo $form->input('discussion_id', array('type' => 'hidden', 'value' => $discussion_id));
		echo $form->input('content', array('label' => __('Message', true)));
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<?php
	echo $this->element('ui/editor');
?>
