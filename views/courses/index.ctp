<div class="courses">
<?php
$i = 0;
foreach ($courses as $course):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
<div class="course">
	<h1><?php echo $course['Course']['name']?></h1>
	<div class="updates">
		<div class="abstract">
			<strong class="title"><?php __('Updates'); ?></strong>
			<div id="plugin-updates">
				<?php
					echo $placeholder->render('plugin_updates', $course['Course']['id']);
				?>
			</div>
		</div>
	</div>
	<div class="professors">
		<div class="abstract">
			<strong class="title"><?php __('Professors'); ?></strong>
		</div>
	</div>
</div>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $course['Course']['id'] ?>
		</td>
		<td>
			<?php echo $html->link(__($course['Department']['name'], true), array('controller'=> 'departments', 'action'=>'view', $course['Department']['id'])); ?>
		</td>
		<td>
			<?php echo $course['Course']['code'] ?>
		</td>
		<td>
			<?php echo $course['Course']['name'] ?>
		</td>
		<td>
			<?php echo $course['Course']['description'] ?>
		</td>
		<td>
			<?php echo $course['Course']['created'] ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $course['Course']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $course['Course']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $course['Course']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $course['Course']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</div>