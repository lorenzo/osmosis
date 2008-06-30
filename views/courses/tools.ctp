<div class="tools">
<h2><?php __('Available Tools'); ?></h2>

<?php 
if(!empty($tools)) :
?>
<ul class="dashboard-elements">
	<?php foreach($tools as $tool) :?>
		<li class="boxed dashboard-element">
			<dl class="plugin">
				<dt>
					<strong class="title">
						<?php
							echo (isset($tool['Tool']['title'])) ?
								$tool['Tool']['title'] : Inflector::humanize($tool['Tool']['name']);
						?>
					</strong>
				</dt>				
				<dd>
					<p>
						<?php
							if (!empty($tool['Tool']['description'])) {
								echo $tool['Tool']['description'];
							} else {
								__('This plugin has no description.');
							}
						?>
					</p>
					<?php if (isset($tool['Tool']['author'])) :?>
						<p class="author">
							<strong><?php echo __('Author')?> </strong>
							<span><?php echo $tool['Tool']['author'] ?></span>
						</p>
					<?php endif;?>
				</dd>
			</dl>
			<div class="go action">
			<?php 
				echo $form->create('Course',array('url'=>array('action' => 'tools',$id)));
				echo $form->input('CourseTool.course_id',array('type'=>'hidden','value'=>$id));
				echo $form->input('CourseTool.plugin_id',array('type'=>'hidden','value'=>$tool['Tool']['id']));
				if (!Set::matches("/Course[id=$id]",$tool)) {
					echo $form->input('CourseTool.add',array('type'=>'hidden','value'=>1));
					$action = __('Add to course', true);
				} else {
					echo $form->input('CourseTool.remove',array('type'=>'hidden','value'=>1));
					$action = __('Remove from course', true);
				}
				echo $form->end($action);
			?>
			</div>
		</li>
	<?php endforeach;?>
</ul>
<?php 
endif;
?>
</div>