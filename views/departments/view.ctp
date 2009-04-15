<?php 
$paginator->options(array('url'=>$this->params['pass']));
?>
<h2><?php echo $department['Department']['name'] ?></h2>
<p>
	<?php echo $department['Department']['description'] ?>
</p>
<div class="related">
	<h3><?php __('Courses')?></h3>
	<?php if (!empty($courses)):?>
	<dl>
	<?php
		$i = 0;
		foreach ($courses as $course):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<dt<?php echo $class;?>>
			<?php
				echo $html->link(
					$course['Course']['name'],
					array(
						'controller'=>'courses',
						'action'=>'view',
						$course['Course']['id']
					), array('class' => "course_name")
				);
			?>
			<ul class="continuous actions">
				<li class="edit">
					<?php
						echo $html->link(
							__('Enroll', true),
							array(
								'controller' => 'courses',
								'action'	=> 'enroll',
								$course['Course']['id']
							), array('class' => 'edit')
						);
					?>
				</li>
			</ul>
		</dt>
		<dd<?php echo $class;?>>
			<?php echo $course['Course']['description'];?>
		</dd>
	<?php endforeach; ?>
	</dl>
		<div class="paging">
			<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
		 | 	<?php echo $paginator->numbers();?>
			<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
		</div>
	<?php endif; ?>
</div>