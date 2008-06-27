<div class="scorm index">
<h2><?php  __('Lessons');?></h2>

<?php if (!empty($scorms)):?>
<?php foreach ($scorms as $scorm): ?>
	<div class="lesson-summary">
		<h3><?php echo $html->link(
			$scorm['Scorm']['name'],
			array('controller'=> 'scorms', 'action'=>'view', $scorm['Scorm']['id'])
			);?>
		</h3>
		<div class="description"><?php echo $filter->filter($scorm['Scorm']['description']);?></div>
	</div>
<?php endforeach; ?>
<?php endif; ?>
</div>
