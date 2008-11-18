<div class="discussions form">
<?php echo $form->create('Discussion',array('url' => array('discussion_id' =>$this->data['Discussion']['id'] ,'topic_id' => $this->data['Discussion']['topic_id'])));?>
	<fieldset>
 		<legend><?php __d('forum','Edit Discussion');?></legend>
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
				'label' => __d('forum','Lock this discussion', true),
				'after' => '<span class="help">'.  __d('forum','(Nobody will be able to reply anymore. Cannot be undone.)', true) . '</span>'
			)
		);
	?>
	<?php
		echo $form->input('sticky', array('label' => __d('forum','Keep this discussion on top', true)));
	?>
	</div>
	</fieldset>
<?php echo $form->end(__d('forum','Submit', true));?>
</div>
<?php
	echo $this->element('ui/editor');
?>