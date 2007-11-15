<?php
class DynamicjsHelper extends Helper {
	
	var $helpers = array('Javascript');
	var $tags = array(
		'javascriptlink' => '<script type="text/javascript" src="%s"></script>',
		'javascriptlinkwithid' => '<script type="text/javascript" src="%s" id="%s"></script>'
	);
	function link($url, $inline = true, $id =null) {
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
		if ($id)
			$out = $this->output(sprintf($this->tags['javascriptlinkwithid'], $url, $id));
		else
			$out = $this->output(sprintf($this->tags['javascriptlink'], $url));

		if ($inline) {
			return $out;
		} else {
			$view =& ClassRegistry::getObject('view');
			$view->addScript($out);
		}

	}
}
?>
