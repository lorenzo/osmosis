<div class="departments">
<h2><?php __('Departments');?></h2>
<dl>
<?php foreach ($departments as $department): ?>
	<dt><?php echo $html->link($department['Department']['name'], array('action'=>'view', $department['Department']['id'])); ?></dt>
	<dd>
		<?php echo $department['Department']['description'] ?>
		<span class="count">[<?php echo sprintf(__('%s Courses',true),count($department['Course'])) ?>]</span>
	</dd>
<?php endforeach;?>
</dl>
	<div class="paging">
		<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $paginator->numbers();?>
		<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
	</div>
</div>
