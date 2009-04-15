<?php 
	echo String::insert(
		__('Hi :name,', true),
		array('name' => $name)
	); ?>


<?php __('We are sending you his email to confirm that your password was successfully reset.'); ?>

<?php 
	echo String::insert(
		__('It\'s a pleasure to welcome you back to :site!', true),
		array('site' => $site)
	);
?>

`
---- <?php __('Note:'); ?> -----------------
<?php __('If you didn\'t do any password recovery, this could mean that somebody guessed your security question.'); ?>

<?php
	echo String::insert(
		__('You should head to :recover_url and change it again.', true),
		array('recover_url' => $html->url(array('controller' => 'members', 'action' => 'recover', 'full_base' => true)))
	);
?>

<?php
	__('And remember to change your security question!');
?>

----------------------------
