<?php
class PagesController extends AppController{
/**
 * Controller name
 *
 * @var string
 * @access public
 */
	var $name = 'Pages';
/**
 * Default helper
 *
 * @var array
 * @access public
 */
	var $helpers = array('Html');
/**
 * This controller does not use a model
 *
 * @var array
 * @access public
 */
	var $uses = array();
/**
 * Displays a view
 *
 * @param mixed What page to display
 * @access public
 */
	function display() {
		if (!func_num_args()) {
			$this->redirect('/');
		}
		$path = func_get_args();

		if (!count($path)) {
			$this->redirect('/');
		}
		$count = count($path);
		$page = null;
		$subpage = null;
		$title = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title = Inflector::humanize($path[$count - 1]);
		}
		$this->set('page', $page);
		$this->set('subpage', $subpage);
		$this->set('title', $title);
		$this->render(join('/', $path));
	}
}
?>