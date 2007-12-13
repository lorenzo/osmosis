<?php
/**
 * Short description for class.
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		cake
 * @subpackage	cake.app.controllers
 */
class PagesController extends AppController{

/**
 * Enter description here...
 *
 * @var unknown_type
 */
	 var $name = 'Pages';

/**
 * Enter description here...
 *
 * @var unknown_type
 */
	 var $helpers = array('Html', 'Javascript');

/**
 * This controller does not use a model
 *
 * @var $uses
 */
	 var $uses = null;

/**
 * Displays a view
 *
 */
	 function display() {
		  if (!func_num_args()) {
				$this->redirect('/');
		  }

		  $path=func_get_args();

		  if (!count($path)) {
				$this->redirect('/');
		  }

		  $count  =count($path);
		  $page   =null;
		  $subpage=null;
		  $title  =null;

		  if (!empty($path[0])) {
				$page = $path[0];
		  }

		  if (!empty($path[1])) {
				$subpage = $path[1];
		  }

		  if (!empty($path[$count - 1])) {
				$title = ucfirst($path[$count - 1]);
		  }

		  $this->set('page', $page);
		  $this->set('subpage', $subpage);
		  $this->set('title', $title);
		  $this->render(join('/', $path));
	 }
}
?>
