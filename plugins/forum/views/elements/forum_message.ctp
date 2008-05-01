<p class="author">
	<?php
		printf(
			__('By %s', true),
			$html->link(
				$author['full_name'],
				array('controller' => 'members', 'action' => 'view', $author['id'], 'plugin' => '')
			)
		);
	?><br />
</p>
<div class="message">
	<div class="content">
		<?php
			$date = $message['created'];
		?>
		<span class="last date">
			<?php
				printf(__('Posted: %s', true), $message['created']);
				if ($message['created']!=$message['modified']) {
					printf(' // ' . __('Modified: %s', true), $message['modified']);
				}
			?>
		</span>
		<?php
			echo $message['content'];
		?>
		<?php
		if ($author['id'] == $session->read('Auth.Member.id')):
		?>
		<p class="actions">
			<?php echo $html->link(__('Edit', true), array('controller' => $controller, 'action' => 'edit', $message['id'])); ?>
		</p>
		<?php
		endif;
		?>
	</div>
</div>