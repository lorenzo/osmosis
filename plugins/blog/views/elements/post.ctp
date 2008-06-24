<h2 id="post<?php echo $post['id']?>" class="post-title">
	<?php echo $html->link($post['title'], array('controller'=>'posts','action'=>'view', $post['slug']));?>
</h2>
<div class="post-date">
	<span class="month"><?php echo $time->format('M', $post['created']);?></span>
	<span class="day"><?php echo $time->format('d', $post['created']);?></span>
</div>
<div class="body">	
	<?php echo $filter->filter($post['body']);?>
</div>
<ul class="reverse actions">
<?php
	if ($post['member_id'] == $Osmosis['active_member']['id']) :
?>
	<li class="delete">
		<?php echo $html->link(__('Delete', true), array('controller'=>'posts', 'action' => 'delete', $post['id'])); ?>		
	</li>
	<li class="edit">
		<?php echo $html->link(__('Edit', true), array('controller'=>'posts', 'action' => 'edit', $post['id'])); ?>		
	</li>
<?php
	endif;
?>
<?php
if (!$single) :
?>
	<li class="info comments">
		<?php
			echo $html->link(
				__('Comments', true),
				array('controller'=>'posts', 'action' => 'view', $post['slug'], '#' => 'comments')
			);
		?>		
	</li>
<?php
endif;
?>
</ul>
