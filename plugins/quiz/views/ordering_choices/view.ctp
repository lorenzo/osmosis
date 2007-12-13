<div class="orderingChoice">
<h2><?php  __('OrderingChoice');?></h2>
	<dl>
		<dt class="altrow"><?php __('Id') ?></dt>
		<dd class="altrow">
			<?php echo $orderingChoice['OrderingChoice']['id'] ?>
			&nbsp;
		</dd>
		<dt><?php __('OrderingQuestion') ?></dt>
		<dd>
			<?php echo $html->link(__($orderingChoice['OrderingQuestion']['id'], true), array('controller'=> 'ordering_questions', 'action'=>'view', $orderingChoice['OrderingQuestion']['id'])); ?>
			&nbsp;
		</dd>
		<dt class="altrow"><?php __('Text') ?></dt>
		<dd class="altrow">
			<?php echo $orderingChoice['OrderingChoice']['text'] ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(sprintf(__('Edit %s', true), __('OrderingChoice', true)), array('action'=>'edit', $orderingChoice['OrderingChoice']['id'])); ?> </li>
		<li><?php echo $html->link(sprintf(__('Delete %s', true), __('OrderingChoice', true)), array('action'=>'delete', $orderingChoice['OrderingChoice']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $orderingChoice['OrderingChoice']['id'])); ?> </li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('OrderingChoices', true)), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('OrderingChoice', true)), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Ordering Questions', true)), array('controller'=> 'ordering_questions', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(sprintf(__('New %s', true), __('Ordering Question', true)), array('controller'=> 'ordering_questions', 'action'=>'add')); ?> </li>
	</ul>
</div>
