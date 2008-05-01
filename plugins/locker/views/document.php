<?php
App::import('View','Media');
class DocumentView extends MediaView {

/**
 * Constructor
 *
 * @param object $controller
 */
	function __construct(&$controller) {
		parent::__construct($controller);
	}

/**
 * Enter description here...
 *
 * @return unknown
 */
	
	function render() {
		$name = null;
		$download = null;
		$extension = null;
		$id = null;
		$modified = null;
		$path = null;
		$size = null;
		if (isset($this->viewVars['mime']) && !empty($this->viewVars['mime']))
			$this->mimeType[$this->viewVars['extension']] = $this->viewVars['mime'];
			
		extract($this->viewVars, EXTR_OVERWRITE);

		if (file_exists($path) && isset($extension) && array_key_exists($extension, $this->mimeType) && connection_status() == 0) {
			$chunkSize = 1 * (1024 * 8);
			$buffer = '';
			$fileSize = @filesize($path);
			$handle = fopen($path, 'rb');
			if ($handle === false) {
				return false;
			}
			if (isset($modified) && !empty($modified)) {
				$modified = gmdate('D, d M Y H:i:s', strtotime($modified, time())) . ' GMT';
			} else {
				$modified = gmdate('D, d M Y H:i:s').' GMT';
			}

			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Last-Modified: $modified");

			if ($download) {
				$contentType = 'application/octet-stream';
				$agent = env('HTTP_USER_AGENT');

				if (preg_match('%Opera(/| )([0-9].[0-9]{1,2})%', $agent) || preg_match('/MSIE ([0-9].[0-9]{1,2})/', $agent)) {
					$contentType = 'application/octetstream';
				}

				header('Content-Type: ' . $contentType);
				header("Content-Disposition: attachment; filename=\"" . $name . '.' . $extension . "\";");
				header("Expires: 0");
				header('Accept-Ranges: bytes');
				header("Cache-Control: private", false);
				header("Pragma: private");

				$httpRange = env('HTTP_RANGE');

				if (isset($httpRange)) {
					list ($toss, $range) = explode("=", $httpRange);
					str_replace($range, "-", $range);

					$size = $fileSize - 1;
					$length = $fileSize - $range;

					header("HTTP/1.1 206 Partial Content");
					header("Content-Length: $length");
					header("Content-Range: bytes $range$size/$fileSize");
					fseek($handle, $range);
				} else {
					header("Content-Length: " . $fileSize);
				}
			} else {
				header("Content-Type: " . $this->mimeType[$extension]);
				header("Content-Length: " . $fileSize);
			}
			@ob_end_clean();

			while (!feof($handle) && connection_status() == 0) {
				set_time_limit(0);
				$buffer = fread($handle, $chunkSize);
				echo $buffer;
				@flush();
				@ob_flush();
			}
			fclose($handle);
			return((connection_status() == 0) && !connection_aborted());
		}
		return false;
	}
}
?>