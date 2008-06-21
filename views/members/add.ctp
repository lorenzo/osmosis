<div class="member">
<?php echo $form->create('Member');?>
	<fieldset>
 		<legend><?php echo sprintf(__('Add %s', true), __('Member', true));?></legend>
	<?php
		echo $form->input('institution_id');
		echo $form->input('name');
		echo $form->input('email');
		echo $form->input('phone');
		echo $form->input('country');
		echo $form->input('city');
		echo $form->input('age');
		echo $form->input('sex');
		echo $form->input('role_id');
		echo $form->input('username');
		echo $form->input('password');
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Members', true)), array('action'=>'index'));?></li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Roles', true)), array('controller'=> 'roles', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('Role', true)), array('controller'=> 'roles', 'action'=>'add')); ?> </li>
	</ul>
</div>
