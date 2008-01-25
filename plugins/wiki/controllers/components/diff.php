<?php
/**
 * Component that rovides functions to purify, prevent xss attacks, and make standard-compliant html code
 */
vendor('Wiki.diff/diff_engine');
class DiffComponent extends Object {
	
	
	function __get($param) {
		if($param == 'formater') {
			$this->formater = new HtmlDiffFormatter();
			return $this->formater;
		}
	}
	
	/**
	 * Initializes the component
	 */
	function startup(&$controller) {
		$this->controller = $controller;
	}
	
	
	function diff($old,$new) {
		//$old = strip_tags($old);
		//$new = strip_tags($new);
		$old = str_replace( "\r\n", "\n", $old );
		$new = str_replace( "\r\n", "\n", $new );
		$old = explode( "\n",$old);
		$new = explode( "\n",$new);
		return new Diff( $old, $new );
	}
	
	function format($diff) {
		$formatter = new HtmlDiffFormatter();
		return $this->formater->format( $diff );
	}
	
	function formatted_diff($old,$new) {
		return $this->format($this->diff($old,$new));
	}
}