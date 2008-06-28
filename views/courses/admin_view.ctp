<div class="courses view">
<h2>[<?php echo $course['Course']['code']; ?>] <?php echo $course['Course']['name'];?></h2>
<p>
	<?php echo $course['Course']['description']; ?>
</p>
<ul class="course-details">
	<li>
		<strong><?php __('Department'); ?>:</strong>
		<?php
			echo $html->link(
				$course['Department']['name'],
				array('controller'=> 'departments', 'action'=>'view', $course['Department']['id'])
			);
		?>
	</li>
	<li>
		<strong><?php __('Owner'); ?>:</strong>
		<?php
			echo $html->link(
				$course['Owner']['full_name'],
				array('controller'=> 'members', 'action'=>'view', $course['Owner']['id'])
			);
		?>
	</li>
	<li>
		<strong><?php __('Created'); ?>:</strong>
		<?php echo $course['Course']['created']; ?>
	</li>
</ul>
</div>
<h3><?php __('Members'); ?></h3>
<?php
	foreach ($roles as $role) :
	$role = $role['Role']['role'];
	$members = array();
	if (isset($enrolled[$role]))
		$members = $enrolled[$role];
?>
<div class="boxed dashboard-element">
	<strong class="title">
		<?php __(Inflector::pluralize($role)); ?> &mdash;
		<?php
			echo $html->link(
				__('add someone', true),
				array(
					'controller' => 'courses',
					'action' => 'enroll',
					'admin' => true,
					$course['Course']['id'],
					'role' => Inflector::underscore($role)
				),
				array('id' => 'add' . $role, 'class' => 'add')
			);
		?>
	</strong>
	<ul id="add<?php echo $role ?>-list">
<?php
	foreach ($members as $i => $member) :
		$member = $member['Member'];
?>
	<li><?php echo $html->link($member['full_name'], array('controller' => 'members', 'action' => 'view', $member['id'])); ?></li>
<?php
	endforeach;
?>
	</ul>
</div>
<?php
endforeach;
$url = sprintf("'%s'",
	$html->url(
		array(
			'admin'			=> true,
			'controller'	=> 'members',
			'ext'			=> 'json',
			'course_id'		=> $course['Course']['id']
		)
	)
);
?>
<script type="text/javascript" charset="utf-8">
	$('.title .add').each(function() {
		var link = this;
		$(this).click(function(evt) {
			evt.preventDefault();
			$('#' + link.id + "-holder input").focus();
		}).parent().after('<div id="' + link.id + '-holder" style="position:relative;" class="addPanel"></div>');
		$('#' + link.id + "-holder")
			.osmosisSelector({
				urlLookup	: <?php echo $url; ?>,
				acOptions	: {
					dataType : "json",
					attachTo : '#' + link.id + '-holder .attach',
					formatItem : function(item) {
						return item.Member.full_name;
					},
					parse : function(items) {
						items = items.response;
						parsed = [];
						for (var i = items.length - 1; i >= 0; i--) {
							parsed[parsed.length] = {
								data : items[i],
								value : items[i].Member.full_name,
								result : items[i].Member.full_name
							};
						};
						return parsed;
					}
				},
				success : function(event, data, formatted) {
					url = link.href;
					$.post(
						url, {"data[Member][id]" : data.Member.id},
						function(response) {
							if (response.status == 'ok') {
								$('#' + link.id + '-list')
									.createAppend('li', null, [
										'a', {href : webroot + 'members/view/' + response.Member.id}, response.Member.full_name
									]);
							}
							$('#' + link.id + '-holder input').val('').focus();
						}, 'json'
					);
				}
			})
			.createAppend('div', {className : 'attach'}, '');
	});
</script>