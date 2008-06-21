<div class="entries form">
	<h1><?php echo $this->data['Entry']['title']?></h1>
<?php echo $form->create('Entry',array('url' => array('wiki_id' => $this->params['named']['wiki_id'])));?>
	<fieldset>
 		<legend><?php __('Edit Entry');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('content',array('label' => array('text' => __('Content',true),'class' => 'hidden')));
		echo $form->hidden('title');
	?>
	</fieldset>
<?php echo $form->end(__('Edit Entry', true));?>
</div>
<?php echo $javascript->link('tiny_mce/tiny_mce',null,null,false); ?>
<?php echo $this->element('ui/editor'); ?>
