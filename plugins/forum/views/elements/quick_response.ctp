<div class="responses form">
<?php echo $form->create('Response',array('url' => array('discussion_id' => $discussion_id)));?>
	<fieldset>
 		<legend><?php __d('forum','Reply to this discussion');?></legend>
	<?php
		echo $form->input('discussion_id', array('type' => 'hidden', 'value' => $discussion_id));
		echo $form->input('content', array('label' => array('class' => 'hidden', 'text' => __d('forum','Message', true))));
	?>
	</fieldset>
<?php echo $form->end(__d('forum','Submit', true));?>
</div>
<?php
	echo $this->element('ui/editor');
?>
