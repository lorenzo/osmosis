<?php
App::import('View','Media');
class ScormView extends MediaView {
	
/**
 * @see View::render
 *
 * @return boolean
 */
	function render() {
		$name = null;
		$extension = null;
		$id = null;
		$modified = null;
		$path = null;
		$size = null;
		extract($this->viewVars, EXTR_OVERWRITE);

		if ($size) {
			$id = $id . "_$size";
		}
		$path = APP . $path . $id;

		if (is_null($name)) {
			$name = $id;
		}
		Configure::write('debug',0);
		if (file_exists($path) && isset($extension) && array_key_exists($extension, $this->mimeType) && connection_status() == 0) {
			$fileSize = @filesize($path);
			
			if (isset($modified) && !empty($modified)) {
				$modified = gmdate('D, d M Y H:i:s', strtotime($modified, time())) . ' GMT';
			} else {
				$modified = gmdate('D, d M Y H:i:s',filemtime($path)).' GMT';
			}

			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Last-Modified: $modified");
			header("Content-Type: " . $this->mimeType[$extension]);
			header("Content-Length: " . $fileSize);
			
			@ob_end_clean();
			echo file_get_contents($path);
			$this->_stop();
		}
		return false;
	}
}
?>