<?php
	if ($entry['revision']==1) {
		$class = 'added' . $class ;
	} else {
		$class = 'edited' . $class;
	}
?>
<li class="<?php echo $class; ?>">
	<?php
		echo $html->link(
			$entry['title'],
			array(
				'controller'	=> 'entries',
				'action'		=>'view',
				$entry['slug'],
				'wiki_id' => $data['Wiki']['id']
			), array('class' => 'title')
		);
	?>
	<span class="note">
		<?php
			$extra = '';
			if ($entry['revision']>1):
				__('created');
				$extra = '&mdash ' .
					$html->link(
						__('view history', true),
						array(
							'controller'	=> 'revisions',
							'action'		=> 'history',
							$entry['id'],
							'wiki_id' => $data['Wiki']['id']
						)
					);
			else :
				__('modified');
			endif;
		?>
		&mdash;
		<?php echo $time->format('d/m/Y', $entry['updated']);?>
		<?php echo $extra; ?>
	</span>
</li>