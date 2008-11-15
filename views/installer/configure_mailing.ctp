<?php $javascript->link('jquery/jquery', false); ?> 
<?php $javascript->link('jquery/plugins/jquery.flydom', false); ?> 
<h1><?php __('Installation'); ?></h1>
<h2>
	<?php printf(__('Step', true) . ' %d: %s', $current_step_position, $current_step_name); ?>
</h2>
<?php
	echo $form->create('Installer', array('url' => array('controller' => 'installer', 'action' => 'index', $current_step)));
?>
<fieldset>
	<legend><?php __('Email sending'); ?></legend>
	<p>
		<?php
			__('Configure the email sending address:')
		?>
	</p>
	<div class="group">
		<strong><?php __('Sending Address'); ?></strong>
		<?php
			echo $form->input('name', array('label'=>__('name', true)));
		?>
		<span>:</span>
		<?php
			echo $form->input('username', array('label'=>__('username', true)));
		?>
		<span>@</span>
		<?php
			echo $form->input('domain', array('label'=>__('domain', true)));
		?>
	</div>
	
</fieldset>
	<?php
		echo $form->input('usesmtp', array('label' => __('Use SMTP', true), 'type' => 'checkbox'));
	?>
	<br />
<fieldset id="smtp">
	<legend><?php __('SMTP Configuration')?></legend>
	<p>
		<?php __('Fill this information if you want Ósmosis to use SMTP to send emails.')?>
	</p>
	<?php
		echo $form->input('smtphost', array('label'=>__('Host', true)));
	?>
	<div class="group">
		<strong><?php __('SMTP credentials'); ?></strong>
		<?php
			echo $form->input('smtplogin', array('label'=>__('Server login', true)));
			echo $form->input('smtppassword', array('label'=>__('Server password', true), 'type' => 'password'));
		?>
	</div>
</fieldset>
<p id="smtp-alternative">
	<?php
		__('PHP\'s <strong>mail</strong> function will be used.');
	?>
</p>
<script type="text/javascript" charset="utf-8">
	$('input#InstallerUsesmtp').change(function() {
		if (this.checked) {
			$('#smtp').show();
			$('#smtp-alternative').hide();
		} else {
			$('#smtp').hide();
			$('#smtp-alternative').show();
		}
	});
</script>
<?php
	echo $form->end(__('Continue', true));
?>