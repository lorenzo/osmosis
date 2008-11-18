<h2><?php __('Members Batch Load') ?></h2>
<div class="member">
<?php echo $form->create('Member',array('type' => 'file','action' => 'batch_load'));?>
	<fieldset>
 		<legend><? __('Upload a CSV file') ?></legend>
	<?php
		echo $form->input('file',array('type' => 'file'));
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
