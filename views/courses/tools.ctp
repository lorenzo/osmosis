<div class="tools">
<h1><?php __('Tools'); ?></h1>

<?php 
if(!empty($tools)) :
?>
<ul>
	<?php foreach($tools as $tool) :?>
		<li class="boxed">
			<dl>
				<dt>
				<strong class="title">
					<?php
						echo (isset($tool['Tool']['title'])) ?
							$tool['Tool']['title'] : Inflector::humanize($tool['Tool']['name']);
					?>
				</strong>
				</dt>				
				<?php if (!empty($tool['Tool']['description'])) :?>
					<dd>
						<p><?php echo $tool['Tool']['description'] ?></p>
						
						<?php if (isset($tool['Tool']['author'])) :?>
							<p class="author">
								<strong><?php echo __('Author')?> </strong>
								<span><?php echo $tool['Tool']['author'] ?></span>
							</p>
						<?php endif;?>
						
					</dd>
				<?php endif;?>
			</dl>
			<div class="actions">
			<?php 
			echo $form->create('Course',array('url'=>array('action' => 'tools',$id)));
			echo $form->input('CourseTool.course_id',array('type'=>'hidden','value'=>$id));
			echo $form->input('CourseTool.plugin_id',array('type'=>'hidden','value'=>$tool['Tool']['id']));
			
			if (!Set::matches("/Course[id=$id]",$tool)) {
				echo $form->input('CourseTool.add',array('type'=>'hidden','value'=>1));
				echo $form->end(__('Add to course',true));
			}
			else {
				echo $form->input('CourseTool.remove',array('type'=>'hidden','value'=>1));
				echo $form->end(__('Remove from course',true));
			}
			?>
			</div>
		</li>
	<?php endforeach;?>
</ul>
<?php 
endif;
?>
</div>