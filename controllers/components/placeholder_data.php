<?php

abstract class PlaceholderDataComponent extends Object {
	
	var $name = 'Placeholder';
	var $components = array('RequestHandler');
	var $cacheExpires = '+1 hour';
	var $cacheKey = null;
	var $type = null;
	var $auto = false;
	
	function startup(& $controller) {
		$this->controller =& $controller;
		if (!isset($this->RequestHandler) && isset($this->controller->RequestHandler)) {
			$this->RequestHandler =& $this->controller->RequestHandler;
		}
		if (!$this->auto || !$this->_continue()) {
			return true;
		}
		$this->process();
	}
	
	
	function process() {
		
		$data= $this->checkCache();
		
		if (!$data) {
			$data= $this->getData();
			$this->saveToCache($data);
		}
		
		$this->setData($data);
	}
	
	
	protected function getCacheKey() {
		
		if (Configure::read('Cache.disbled')) {
			return false;
		}
		
		if ($this->cacheKey) {
			return $this->cacheKey;
		}
		
		if ($this->controller->plugin) {
			$path[]= $this->controller->plugin;
		}
		
		$key[]= 'Placeholder';
		$key[]= $this->name;
		$cacheKey= implode($key, '.');
		$this->cacheKey= $cacheKey;
		
		return $cacheKey;
	}
	
	
	private function checkCache() {
		
			if (Configure::read('Cache.disbled')) {
				return false;
			}
			
			if (!($cache = Cache::read($this->cacheKey))) {
				return false;
			}
			return $cache;
	}
	
	private function setData($data) {
		
		if ($data) {
			if (!Configure::read('Cache.disbled') && ($this->cacheExpires)) {
				$elementData['cache'] = $this->cacheExpires;
			}
			$elementData['data'] = $data;
			
			if (isset($data['sequence'])) {
				 $elementData['sequence'] = $data['sequence'];
				unset($data['sequence']);
			}
			
			$this->controller->viewVars['placeholders'][$this->type][$this->name]= $elementData;
			
			}
	}
	
	private function saveToCache($data) {
		
		if (Configure::read('Cache.disbled')) {
			return false;
		}
		return Cache::write($this->getCacheKey(),$data,$this->cacheExpires);
	}
	
	protected function _continue() {
		
		if (isset ($this->controller->params['requested']) ||
			(isset($this->RequestHandler) && $this->RequestHandler->isAjax())
			) {
                 	return false;
		}
		return true;
	}
	
	protected abstract function getData();
}
?>