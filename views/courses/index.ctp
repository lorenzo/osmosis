<?php
	$javascript->link('jquery/plugins/jquery.dimensions', false);
	$javascript->link('jquery/plugins/jquery.easing', false);
	$javascript->link('jquery/plugins/jquery.accordion', false);
?>
<div id="my-courses">
<?php
$i = 0;
foreach ($courses as $course):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<h1>
	<?php
		echo $html->link(
			__('Go to course',true),
			array('controller' => 'courses', 'action' => 'view', $course['Course']['id']),
			array('class' => 'goto')
		);
	?>
	<?php
		echo $html->link(
			$text->truncate($course['Course']['name'],45),
			array('controller' => 'courses', 'action' => 'view', $course['Course']['id']),
			array('class' => 'title')
		);
	?>
	</h1>
	<div class="course" style="float:left;width:100%">
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
				<?php
					$prof = isset($professors[$course['Course']['id']]) ? $professors[$course['Course']['id']] : array();
					echo $this->element('professor_list', array('professors' => $prof));
				?>
			</div>
		</div>
	</div>
<?php endforeach; ?>
</div>
<script type="text/javascript" charset="utf-8">
jQuery(document).ready(function(){
	$($("#my-courses h1 a.title").click(function() {
		$(this).parent('h1').next().toggle("fast");
		return false;
	}).parent('h1').next().hide().prev().get(0)).next().show();
});
</script>