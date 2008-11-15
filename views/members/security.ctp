<h1><?php __('Security Options'); ?></h1>
<p>
	<?php
		__('Please select a security question and write an answer to it.');
		echo '<br />';
		__('This will help you regain access if you forget your username or password.');
	?>
</p>
<?php
	echo $form->create('Member', array('url' => array('action' => 'security')));
	echo $form->input('question', array('empty' => true));
	echo $form->input('answer', array('size' => 50));
	echo $form->end(__('Submit', true));
?>