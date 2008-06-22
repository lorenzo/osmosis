<h3 id="post<?php echo $post['id']?>" class="post-title"><?php echo $html->link($post['title'], array('controller'=>'posts','action'=>'view', $post['slug']));?></h3>
<div class="date">
	<span class="month"><?php echo $time->format('M', $post['created']);?></span>
	<span class="day"><?php echo $time->format('d', $post['created']);?></span>
</div>
<div class="body">	
	<?php echo $filter->filter($post['body']);?>
</div>
<?php echo $html->link(__('Edit', true), array('controller'=>'posts', 'action' => 'edit', $post['id'])); ?>