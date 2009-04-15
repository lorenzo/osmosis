<div id="actions" class="boxed dashboard-element">
	<strong class="title"><?php __d('locker','Locker'); ?></strong>
	<div id="locker-contents" class="mini">
		<p>
			<?php __d('locker','These are the Documents sent to you by other members.'); ?> 
			<?php
				if (isset($data['LockerFolder']['id'])) {
					echo $html->link(
						__d('locker','Go to your dropbox', true),
						array(
							'plugin'		=> 'locker',
							'controller'	=> 'folders',
							'action'		=> 'view',
							$data['LockerFolder']['id']
						)
					);
				}
			?>
		</p>
		<?php
			if (isset($data['Document'])) :
		?>
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
		<?php
			endif;
		?>
		<p class='go'>
			<?php
				echo $html->link(
					__d('locker','Go to your locker', true),
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