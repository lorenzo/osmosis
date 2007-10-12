<div class="scoPresentation">
<h2><?php  __('ScoPresentation');?></h2>
	<dl>
		<dt class="altrow">Id</dt>
		<dd class="altrow">
			<?php echo $scoPresentation['ScoPresentation']['id']?>
			&nbsp;
		</dd>
		<dt>HideKey</dt>
		<dd>
			<?php echo $scoPresentation['ScoPresentation']['hideKey']?>
			&nbsp;
		</dd>
		<dt class="altrow">Sco Id</dt>
		<dd class="altrow">
			<?php echo $scoPresentation['ScoPresentation']['sco_id']?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit', true).' '.__('ScoPresentation', true),   array('action'=>'edit', $scoPresentation['ScoPresentation']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete', true).' '.__('ScoPresentation', true), array('action'=>'delete', $scoPresentation['ScoPresentation']['id']), null, __('Are you sure you want to delete', true).' #' . $scoPresentation['ScoPresentation']['id'] . '?'); ?> </li>
		<li><?php echo $html->link(__('List', true).' '.__('ScoPresentations', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('ScoPresentation', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
