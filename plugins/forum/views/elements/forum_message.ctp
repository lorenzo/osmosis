<p class="author">
	<?php
		printf(
			__d('forum','By %s', true),
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
				printf(__d('forum','Posted: %s', true), $message['created']);
				if ($message['created']!=$message['modified']) {
					printf(' // ' . __d('forum','Modified: %s', true), $message['modified']);
				}
			?>
		</span>
		<?php
			echo $filter->filter($message['content']);
		?>
		<?php
		if ($author['id'] == $session->read('Auth.Member.id') || in_array($Osmosis['currentRole'],a('Assistant','Professor','Admin'))):
		?>
		<p class="actions">
			<?php
				echo $html->link(
					__d('forum','Edit', true),
					array(
						'controller' => $controller,
						'action' => 'edit',
						Inflector::singularize($controller) . '_id' =>  $message['id']
					)
				);
			?>
		</p>
		<?php
		endif;
		?>
	</div>
</div>