<p class="author">
	<?php printf(__('By %s', true), $author['full_name']); ?> <br />
</p>
<div class="message">
	<div class="content">
		<?php
			$date = $message['created'];
			$date_label = __('Posted: %s', true);
			if ($message['created']!=$message['modified']) {
				$date = $message['modified'];
				$date_label = __('Modified: %s', true);
			}
		?>
		<span class="last date"><?php printf($date_label, $time->nice($date)); ?></span>
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