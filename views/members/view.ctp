<div class="member">
<h2><?php  __('Profile');?></h2>
<?php
	echo $this->element('dashboard/profile', array('user' => $member['Member']));
?>
</div>