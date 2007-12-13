<div class="associationChoice">
<h2><?php  __('AssociationChoice');?></h2>
	<dl>
		<dt class="altrow"><?php __('Id') ?></dt>
		<dd class="altrow">
			<?php echo $associationChoice['AssociationChoice']['id'] ?>
			&nbsp;
		</dd>
		<dt><?php __('AssociationQuestion') ?></dt>
		<dd>
			<?php echo $html->link(__($associationChoice['AssociationQuestion']['id'], true), array('controller'=> 'association_questions', 'action'=>'view', $associationChoice['AssociationQuestion']['id'])); ?>
			&nbsp;
		</dd>
		<dt class="altrow"><?php __('Text') ?></dt>
		<dd class="altrow">
			<?php echo $associationChoice['AssociationChoice']['text'] ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(sprintf(__('Edit %s', true), __('AssociationChoice', true)), array('action'=>'edit', $associationChoice['AssociationChoice']['id'])); ?> </li>
		<li><?php echo $html->link(sprintf(__('Delete %s', true), __('AssociationChoice', true)), array('action'=>'delete', $associationChoice['AssociationChoice']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $associationChoice['AssociationChoice']['id'])); ?> </li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('AssociationChoices', true)), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('AssociationChoice', true)), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Association Questions', true)), array('controller'=> 'association_questions', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('Association Question', true)), array('controller'=> 'association_questions', 'action'=>'add')); ?> </li>
	</ul>
</div>
