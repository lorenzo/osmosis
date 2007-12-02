<?php
/**
 * Component that rovides functions to purify, prevent xss attacks, and make standard-compliant html code
 */
class HtmlPurifierComponent extends Object {
	
	function __get($member) {
		if($member == 'lib') {
			vendor('html_purifier/HTMLPurifier.auto');
			$config = HTMLPurifier_Config::createDefault();
			$config->set('Cache','SerializerPath',CACHE);
			$config->set('HTML', 'TidyLevel', 'heavy');
			$this->lib = new HTMLPurifier($config);
			return $this->lib;
		}
	}
	
	/**
	 * Initializes the component
	 */
	function startup(&$controller) {
		$this->controller = $controller;
	}
	
	/**
	 * Cleans $html from possible xss and strip tags out from a whitelist. It also performs a replace of
	 * non-standart tags and converts them into a well-formatted html string.
	 *
	 * @param string $html
	 */
	
	function purify($html) {
		return $this->lib->purify($html);
	}
}