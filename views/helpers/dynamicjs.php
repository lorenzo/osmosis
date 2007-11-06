<?php
class DynamicjsHelper extends Helper {
	
	var $helpers = array('Javascript');
	
	function link($url, $inline = true) {
		if (is_array($url)) {
			$out = '';
			foreach ($url as $i) {
				$out .= "\n\t" . $this->link($i, $inline);
			}
			if ($inline)  {
				return $out . "\n";
			}
			return;
		}

		if (strpos($url, '.js') === false && strpos($url, '?') === false) {
			$url .= '.js';
		}
		if (strpos($url, '://') === false) {
			$url = $this->webroot($url);
		}
		$out = $this->output(sprintf($this->Javascript->tags['javascriptlink'], $url));

		if ($inline) {
			return $out;
		} else {
			$view =& ClassRegistry::getObject('view');
			$view->addScript($out);
		}

	}
}
?>
