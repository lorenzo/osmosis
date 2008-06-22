<div class="responses form">
<?php echo $form->create('Response');?>
	<fieldset>
 		<legend><?php __('Edit Response');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('content');
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<?php
	echo $this->element('ui/editor');
?>