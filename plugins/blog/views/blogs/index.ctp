<div class="blogs index">
<h2><?php __d('blog','Blogs');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __d('blog','Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('title');?></th>
	<th><?php echo $paginator->sort('description');?></th>
	<th><?php echo $paginator->sort('member_id');?></th>
	<th class="actions"><?php __d('blog','Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($blogs as $blog):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $blog['Blog']['id']; ?>
		</td>
		<td>
			<?php echo $blog['Blog']['title']; ?>
		</td>
		<td>
			<?php echo $blog['Blog']['description']; ?>
		</td>
		<td>
			<?php echo $blog['Blog']['member_id']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__d('blog','View', true), array('action'=>'view', $blog['Blog']['id'])); ?>
			<?php echo $html->link(__d('blog','Edit', true), array('action'=>'edit', $blog['Blog']['id'])); ?>
			<?php echo $html->link(__d('blog','Delete', true), array('action'=>'delete', $blog['Blog']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $blog['Blog']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__d('blog','previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__d('blog','next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__d('blog','New Blog', true), array('action'=>'add')); ?></li>
	</ul>
</div>
