<div class="controlMode">
<h2><?php  __('ControlMode');?></h2>
	<dl>
		<dt class="altrow">Id</dt>
		<dd class="altrow">
			<?php echo $controlMode['ControlMode']['id']?>
			&nbsp;
		</dd>
		<dt>Sco Id</dt>
		<dd>
			<?php echo $controlMode['ControlMode']['sco_id']?>
			&nbsp;
		</dd>
		<dt class="altrow">ChoiceExit</dt>
		<dd class="altrow">
			<?php echo $controlMode['ControlMode']['choiceExit']?>
			&nbsp;
		</dd>
		<dt>Choice</dt>
		<dd>
			<?php echo $controlMode['ControlMode']['choice']?>
			&nbsp;
		</dd>
		<dt class="altrow">Flow</dt>
		<dd class="altrow">
			<?php echo $controlMode['ControlMode']['flow']?>
			&nbsp;
		</dd>
		<dt>ForwardOnly</dt>
		<dd>
			<?php echo $controlMode['ControlMode']['forwardOnly']?>
			&nbsp;
		</dd>
		<dt class="altrow">UseCurrentAttemptObjectiveInfo</dt>
		<dd class="altrow">
			<?php echo $controlMode['ControlMode']['useCurrentAttemptObjectiveInfo']?>
			&nbsp;
		</dd>
		<dt>UseCurrentAttemptProgressInfo</dt>
		<dd>
			<?php echo $controlMode['ControlMode']['useCurrentAttemptProgressInfo']?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit', true).' '.__('ControlMode', true),   array('action'=>'edit', $controlMode['ControlMode']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete', true).' '.__('ControlMode', true), array('action'=>'delete', $controlMode['ControlMode']['id']), null, __('Are you sure you want to delete', true).' #' . $controlMode['ControlMode']['id'] . '?'); ?> </li>
		<li><?php echo $html->link(__('List', true).' '.__('ControlModes', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('ControlMode', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
