<?php echo $form->create('Member');?>
	<fieldset class="twocol">
 		<legend><?php __('Edit Profile');?></legend>
		<fieldset class="col">
			<legend><?php __('Personal Data')?></legend>
			<?php
				echo $form->input('id');
				echo $form->input('full_name');
				echo $form->input('email');
				echo $form->input('phone');
				echo $form->input('age');
				echo $form->input('sex', array('options' => array('F' => __('Female', true), 'M' => __('Male', true)), 'empty' => true));
			?>
		</fieldset>
		<fieldset class="col">
			<legend><?php __('Institutional Information')?></legend>
			<?php
				echo $form->input('institution_id', array('label' => __('Institution ID', true)));
			?>
		</fieldset>
		<fieldset class="col">
			<legend><?php __('Location'); ?></legend>
			<?php
				echo $form->input('country');
				echo $form->input('city');
			?>
		</fieldset>
		<fieldset class="full">
			<legend><?php __('Access Information')?></legend>
			<?php
				echo $form->input('password');
				echo $form->input('password_confirm', array('type' => 'password'));
				if ($Osmosis['active_member']['admin'])
					echo $form->input('admin', array('label' => __('Give this user administrative access', true)));
			?>
		</fieldset>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>