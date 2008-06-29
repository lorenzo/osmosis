<div class="wikis form">
<?php echo $form->create('Wiki', array('url' => array('wiki_id' => $this->data['Wiki']['id'])));?>
	<fieldset>
 		<legend><?php __('Edit Wiki');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name', array('label' => __('Title', true), 'size' => 60));
		echo $form->input('description');
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<?php echo $this->element('ui/editor'); ?>