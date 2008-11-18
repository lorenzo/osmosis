<div class="blogs form">
<?php echo $form->create('Blog');?>
	<fieldset>
 		<legend><?php __d('blog','Add Blog');?></legend>
	<?php
		echo $form->input('title');
		echo $form->input('description');
	?>
	</fieldset>
<?php echo $form->end(__d('blog','Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__d('blog','List Blogs', true), array('action'=>'index'));?></li>
	</ul>
</div>
