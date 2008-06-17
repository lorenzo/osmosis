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
	<h1><?php
		echo $html->link(
			$course['Course']['name'],
			array('controller' => 'courses', 'action' => 'view', $course['Course']['id']),
			array('class' => 'title')
		);
	?></h1>
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
					echo $this->element('professor_list', array('professors' => $professors[$course['Course']['id']]));
				?>
			</div>
		</div>
	</div>
<?php endforeach; ?>
</div>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		var acc = $('#my-courses').accordion({
			header : 'h1',
			autoheight : false,
			animate : 'easeslide',
			event : false
		});
		$('a.title', acc).each(function(index) {
			$(this).click(function(evt) {
				if (!$(this).parent().hasClass('selected')) {
					evt.preventDefault();
				}
				console.debug(index)
				acc.accordion("activate", index);
			});
		});
	});
</script>