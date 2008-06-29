<div class="revisions history">
	<h2><?php echo sprintf(__('Revision history of "%s"',true), $entry['Entry']['title']);?></h2>
	<table cellspacing="0">
		<tr>
			<th><?php __('Revision'); ?></th>
			<th><?php __('Modified by')?></th>
			<th><?php __('Date'); ?></th>
			<th>&nbsp;</th>
		</tr>
		<tr>
			<td><?php
				echo $html->link(
					__('Current revision', true),
					array(
						'action'	=> 'view',
						$entry['Entry']['id'],
						'wiki_id'	=> $entry['Entry']['wiki_id']
					), array('title' => __('View this revision', true))
				);
			?></td>
			<td><?php echo $entry['Member']['username']?></td>
			<td><?php
				echo  $time->format('d/m/Y (H:i)', $entry['Entry']['created']);
			?></td>
			<td><?php
				echo $html->link(
					__('compare to previous', true),
					array(
						'action'	=>'diff',
						$entry['Entry']['id'],
						'wiki_id'	=> $entry['Entry']['wiki_id']
					)
				);
			?></td>
		</tr>
		<?php
			$i = 0;
			foreach ($revisions as $i => $revision) :
				$class = $previous = null;
				if (isset($revisions[$i+1])) {
					$previous = $revisions[$i+1]['Revision']['id'];
				}
				if ($i++%2 == 0) {
					$class = ' class="altrow"';
				}
		?>
		<tr<?php echo $class?>>
			<td><?php
				echo $html->link(
					__('Revision', true) . ' ' . $revision['Revision']['revision'],
					array(
						'action'	=> 'view',
						$revision['Revision']['id'],
						'wiki_id'	=> $entry['Entry']['wiki_id']
					), array('title' => __('View this revision', true))
				);
			?></td>
			<td><?php printf(__('by %s at', true), $revision['Member']['username']); ?></td>
			<td><?php
				echo $time->format('d/m/Y (H:i)', $revision['Revision']['created'])
			?></td>
			<td>
				<?php
					if ($previous) :
						echo $html->link(
							__('compare to previous', true),
							array(
								'action'	=>'diff',
								$entry['Entry']['id'],
								$revision['Revision']['id'],
								'wiki_id'	=> $entry['Entry']['wiki_id']
							)
						);
					else:
						echo "&nbsp;";
					endif;
				?>
			</td>
		</tr>
<?php
	endforeach;
?>
	</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
