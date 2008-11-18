<div class="posts index">
<h2><?php __d('blog','Posts');?></h2>
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
	<th><?php echo $paginator->sort('body');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
	<th><?php echo $paginator->sort('blog_id');?></th>
	<th class="actions"><?php __d('blog','Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($posts as $post):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $post['Post']['id']; ?>
		</td>
		<td>
			<?php echo $post['Post']['title']; ?>
		</td>
		<td>
			<?php echo $post['Post']['body']; ?>
		</td>
		<td>
			<?php echo $post['Post']['created']; ?>
		</td>
		<td>
			<?php echo $post['Post']['modified']; ?>
		</td>
		<td>
			<?php echo $html->link($post['Blog']['title'], array('controller'=> 'blogs', 'action'=>'view', $post['Blog']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__d('blog','View', true), array('controller'=> 'posts', 'action'=>'view', $post['Post']['slug']));?>
			<?php echo $html->link(__d('blog','Edit', true), array('action'=>'edit', $post['Post']['id'])); ?>
			<?php echo $html->link(__d('blog','Delete', true), array('action'=>'delete', $post['Post']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $post['Post']['id'])); ?>
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
		<li><?php echo $html->link(__d('blog','New Post', true), array('controller'=> 'posts', 'action'=>'add', $post['Post']['blog_id'])); ?></li>
		<li><?php echo $html->link(__d('blog','List Blogs', true), array('controller'=> 'blogs', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__d('blog','New Blog', true), array('controller'=> 'blogs', 'action'=>'add')); ?> </li>
		
	</ul>
</div>
