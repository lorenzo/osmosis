<div class="entries form">
<?php echo $form->create('Entry',array('url' => array('wiki_id' => $this->data['Entry']['wiki_id'])));?>
	<fieldset>
 		<legend><?php __d('wiki','Add Entry');?></legend>
	<?php
		echo $form->hidden('wiki_id');
		$options = array('size' => 60);
		if (isset($this->params['named']['title']))
			$options['value'] = $this->params['named']['title'];
		echo $form->input('title', $options);
		echo $form->input('content',array('label' => array('text' => __d('wiki','Content',true),'class' => 'hidden')));
	?>
	</fieldset>
<?php echo $form->end(__d('wiki','Add Entry', true));?>
</div>
<?php echo $javascript->link('tiny_mce/tiny_mce',null,null,false); ?>
<?php echo $this->element('ui/editor'); ?>