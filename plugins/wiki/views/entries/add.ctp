<div class="entries form">
<?php echo $form->create('Entry',array('url' => array('wiki_id' => $this->data['Entry']['wiki_id'])));?>
	<fieldset>
 		<legend><?php __('Add Entry');?></legend>
	<?php
		echo $form->hidden('wiki_id');
		$options = array();
		if (isset($this->params['named']['title']))
			$options = array('value' => $this->params['named']['title']);
		echo $form->input('title',$options);
		echo $form->input('content',array('label' => array('text' => __('Content',true),'class' => 'hidden')));
	?>
	</fieldset>
<?php echo $form->end(__('Add Entry', true));?>
</div>
<?php echo $javascript->link('tiny_mce/tiny_mce',null,null,false); ?>
<?php echo $this->element('ui/editor'); ?>