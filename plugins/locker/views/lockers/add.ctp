<div class="lockers form">
<?php echo $form->create('Locker');?>
	<fieldset>
 		<legend><?php __('Add Locker');?></legend>
	<?php
		echo $form->input('member_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Lockers', true), array('action'=>'index'));?></li>
	</ul>
</div>
