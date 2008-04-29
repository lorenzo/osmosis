<div class="entries form">
<?php echo $form->create('Entry');?>
	<fieldset>
 		<legend><?php __('Add Entry');?></legend>
	<?php
		echo $form->hidden('wiki_id');
		$options = array();
		if (isset($this->params['named']['title']))
			$options = array('value' => $this->params['named']['title']);
		echo $form->input('title',$options);
		echo $form->input('content');
	?>
	</fieldset>
<?php echo $form->end('Add Entry');?>
</div>
<?php echo $javascript->link('tiny_mce/tiny_mce',null,null,false); ?>
<?php echo $this->renderElement('ui/editor'); ?>