<div class="responses form">
<?php echo $form->create('Response',array('url' => array('response_id' => $this->data['Response']['id'])));?>
	<fieldset>
 		<legend><?php __d('forum','Edit Response');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('content');
	?>
	</fieldset>
<?php echo $form->end(__d('forum','Submit', true));?>
</div>
<?php
	echo $this->element('ui/editor');
?>