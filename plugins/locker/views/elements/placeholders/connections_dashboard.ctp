<div id="actions" class="boxed dashboard-element">
	<strong class="title"><?php __('Locker'); ?></strong>
	<div id="locker-contents" class="mini">
		<p>
			<?php __('These are the Documents sent to you by other members.'); ?> 
			<?php
				echo $html->link(
					__('Go to your dropbox', true),
					array(
						'plugin'		=> 'locker',
						'controller'	=> 'folders',
						'action'		=> 'view',
						$data['LockerFolder']['id']
					)
				);
			?>
		</p>
		<ul>
		<?php
			foreach ($data['Document'] as $i => $document) :
				echo $this->element('file_info',
					array(
						'file' => $document,
						'type' => 'document',
						'wrap_names' => false,
						'parentFolder' => $document,
						'plugin' => 'locker'
					), true
				);
			endforeach;
		?>
		</ul>
		<p class='go'>
			<?php
				echo $html->link(
					__('Go to your locker', true),
					array(
						'plugin'		=> 'locker',
						'controller'	=> 'folders',
						'action'		=> 'view',
						'member_id'		=> $data['Member']['id']
					)
				);
			?>
		</p>
	</div>
</div>