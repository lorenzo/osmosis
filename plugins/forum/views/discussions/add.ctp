<div class="discussions form">
<?php echo $form->create('Discussion');?>
	<fieldset>
 		<legend><?php __('New Discussion');?></legend>
	<?php
		echo $form->input('topic_id', array('type' => 'hidden'));
		echo $form->input('title', array('size'=>'75'));
		echo $form->input('content');
	?>
	<div class="checkbox">
		<?php echo $form->input('sticky', array('label' => __('Keep this discussion on top', true))); ?>
	</div>
	</fieldset>
<?php echo $form->end(__('Create Discussion', true));?>
</div>
<?php
	echo $this->renderElement('ui/editor');
?>