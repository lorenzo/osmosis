<div class="plugins index">
<h1><?php __('Plugins'); ?></h1>

<?php if(!empty($plugins)) :?>
<h2><?php __('Installed'); ?></h2>
<ul>
	<?php foreach($plugins as $plugin) :?>
	<li>
		<li class="boxed">
			<dl>
				<dt>
				<strong class="title">
					<?php
						echo (isset($plugin['Plugin']['title'])) ?
							$plugin['Plugin']['title'] : Inflector::humanize($plugin['Plugin']['name']);
					?>
				</strong>
				</dt>				
				<?php if (!empty($plugin['Plugin']['description'])) :?>
					<dd>
						<?php echo $plugin['Plugin']['description'] ?>
						
						<?php if (isset($plugin['Plugin']['author'])) :?>
						<strong class="author"><?php echo __('Author')?> </strong>
						<span><?php echo $plugin['Plugin']['author'] ?></span>
						<?php endif;?>
						
					</dd>
				<?php endif;?>
			</dl>
			<div class="actions installed">
			<?php echo $html->link(__('Uninstall',true),
				array('controller' => 'plugins' ,'action' => 'uninstall', Inflector::underscore($plugin['Plugin']['id']))); 
			?>
			<?php
			 	if (!$plugin['Plugin']['active'])
					echo $html->link(__('Activate',true),
					array('controller' => 'plugins' ,'action' => 'activate', Inflector::underscore($plugin['Plugin']['id'])));
				else 
					echo $html->link(__('Deactivate',true),
					array('controller' => 'plugins' ,'action' => 'deactivate', Inflector::underscore($plugin['Plugin']['id'])));
			 ?>
			</div>
		</li>
	</li>
	<?php unset($inServer[$plugin['Plugin']['name']]); ?>
	<?php endforeach;?>
</ul>
<?php endif; ?>

<?php if(!empty($inServer)) :?>
<h2 style="clear:both"><?php __('Not Installed');?></h2>
<ul>
	<?php foreach ($inServer as $key => $plugin) :?>
	<li class="boxed">
		<dl>
			<dt><strong class="title"><?php echo (isset($plugin['title'])) ? $plugin['title'] : Inflector::humanize($key); ?></strong></dt>
			
			<?php if (isset($plugin['description'])) :?>
			<dd>
				<?php echo $plugin['description'] ?>
				<?php if (isset($plugin['author'])) :?>
					
				<strong class="author"><?php echo __('Author')?> </strong>
				<span><?php echo $plugin['author'] ?></span>
				<?php endif;?>
			</dd>
			<?php endif;?>
			
		</dl>
		<div class="actions uninstalled">
		<?php echo $html->link(__('Install',true),
			array('controller' => 'plugins' ,'action' => 'install', Inflector::underscore($key))); ?>
		</div>
	</li>
	<?php endforeach;?>
</ul>
<?php endif; ?>
</div>