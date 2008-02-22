<?php
/**
 * Defines a template class for setting arbitrary data to the view from any plugin
 *
 */

abstract class PlaceholderDataComponent extends Object {
	
	/**
	 * Name of this class
	 *
	 * @var string
	 */
	
	var $name = 'Placeholder';
	
	/**
	 * Components that will be used during the execution of this class 
	 *
	 * @var array
	 */
	
	var $components = array('RequestHandler');
	
	/**
	 * Default time to expire the cache data
	 *
	 * @var string
	 */
	
	var $cacheExpires = '+1 hour';
	
	/**
	 * Default key for storing cache data
	 *
	 * @var string
	 */
	
	var $cacheKey = null;
	
	/**
	 * Defines the type of placeholder this class is pretended to
	 *
	 * @var string
	 */
	
	var $type = null;
	
	/**
	 * Whether send the processed data to the view during the startup() call or not
	 *
	 * @var boolean
	 */
	
	var $auto = false;
	
	/**
	 * Startup function. If $auto is set to true, it will send the data directly to the view
	 *
	 * @param string $controller reference to the including controller
	 * @return boolean
	 */
	
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
	
	/**
	 * Generates the data and sends it to the view. It checks first if the data is available in the cache
	 *
	 * @return void
	 */
	
	function process() {
		
		$data= $this->checkCache();
		
		if (!$data) {
			$data= $this->getData();
			$this->saveToCache($data);
		}
		
		$this->setData($data);
	}
	
	/**
	 * Returns the cache key where the data will be stored
	 *
	 * @return string The cache key
	 */
	
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
	
	/**
	 * Returns the cache stored data if is available 
	 *
	 * @return mixed array if the data was found. False otherwise
	 */
	
	private function checkCache() {
		
			if (Configure::read('Cache.disbled')) {
				return false;
			}
			
			if (!($cache = Cache::read($this->cacheKey))) {
				return false;
			}
			return $cache;
	}
	
	/**
	 * Sends the data to the view.
	 *
	 * @param array $data
	 * @return void
	 */
	
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
	
	/**
	 * Stores the data in the cache
	 *
	 * @param mixed $data 
	 * @return boolean true on success.
	 */
	
	private function saveToCache($data) {
		
		if (Configure::read('Cache.disbled')) {
			return false;
		}
		return Cache::write($this->getCacheKey(),$data,$this->cacheExpires);
	}
	
	/**
	 * Whether is ok to continue processing the data (i.e fetch it and send it to the view) or not
	 *
	 * @return boolean true if is ok to continue
	 */
	
	protected function _continue() {
		
		if (isset ($this->controller->params['requested']) ||
			(isset($this->RequestHandler) && $this->RequestHandler->isAjax())
			) {
                 	return false;
		}
		return true;
	}
	
	/**
	 * Returns the data that will be sent to the view. It must be implemented in subclasses
	 *
	 * @return mixed
	 */
	
	protected abstract function getData();
}
?>