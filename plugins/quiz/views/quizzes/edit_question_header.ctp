<?php if (!empty($isAjax)) :?>
<?php echo $this->data['QuizQuestion']['header'];?>
<?php else :?>
<div class="quiz">
<?php echo $form->create('QuizQuestion',array('url' => array(
			'action' => $this->action,
			'controller' => 'quizzes',
			) + $this->params['pass']
		)
	);
?>
	<fieldset>
 		<legend><?php echo __('Edit Question header', true);?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('header',array('type' => 'textarea'));
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
<?php echo $this->element('ui/editor');?>
</div>
<?php endif;?>