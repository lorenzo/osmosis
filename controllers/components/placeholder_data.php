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
	
	
	var $cache = true;
	
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
	 * Defines the placeholders in which this component will participate sending data
	 *
	 * @var array
	 */
	var $types = array();
	
	/**
	 * Whether send the processed data to the view during the startup() call or not
	 *
	 * @var boolean
	 */
	
	var $auto = false;
	
	/**
	 * An array of configure valus that will be sent to the view, indexed by placeholder type.
	 *
	 * @var array
	 */
	
	var $config = array();
	
	/**
	 * Startup function. If $auto is set to true, it will send the data directly to the view
	 *
	 * @param string $controller reference to the including controller
	 * @param string $type the name of the placeholder for which the data will be sent.
	 * @return boolean
	 */
	
	function startup(&$controller, $type = null) {
		$this->controller =& $controller;
		if (!isset($this->RequestHandler) && isset($this->controller->RequestHandler)) {
			$this->RequestHandler =& $this->controller->RequestHandler;
		}
		
		if (!$type)
			$type = $this->types[0];
		
		if (!$this->auto || !$this->_continue($type)) {
			return true;
		}
		$this->process($type);
	}
	
	/**
	 * Stores a configuration key and value for this object to be sent later to the view
	 *
	 * @param string $type the name of the placeholder for which the data will be sent.
	 * @param mixed $config array with key => value pairs, or name of key
	 * @param mixed $value value for configure key
	 * @return void
	 */
	
	function setConfig($type,$config,$value = null) {
		if (is_array($config) &&!empty($config)) {
			if (isset($this->config[$type]))
				$this->config[$type] = Set::merge($this->config[$type],$config);
			else
				$this->config[$type] = $config;
		} else
			$this->config[$type][$config] = $value;
	}
	
	/**
	 * Generates the data and sends it to the view. It checks first if the data is available in the cache
	 * @param string $type the name of the placeholder for which the data will be sent.
	 * @return void
	 */
	
	function process($type = null) {
		
		$data = $this->checkCache($type);
		
		if (!$data) {
			$data = $this->getData($type);
			if($data !== false) {
				$this->saveToCache($data, $type);
			} else {
				return;
			}
		}
		
		$this->setData($data, $type);
	}
	
	/**
	 * Returns the cache key where the data will be stored
	 * @param string $type the name of the placeholder for which the cache will be stored
	 * @return string The cache key
	 */
	
	protected function getCacheKey($type = null) {
		
		if (Configure::read('Cache.disbled')) {
			return false;
		}
		
		if ($this->cacheKey) {
			return $this->cacheKey;
		}
		
		$key[] = 'Placeholder';
		$key[] = $this->name;
		$key[] = $type;
		$cacheKey= implode($key, '.');
		
		return $cacheKey;
	}
	
	/**
	 * Returns the cache stored data if is available 
	 * @param string $type the name of the placeholder for which the cache will be checked
	 * @return mixed array if the data was found. False otherwise
	 */
	
	private function checkCache($type = null) {
		
			if (Configure::read('Cache.disbled') || !$this->cache) {
				return false;
			}
			
			if (!($cache = Cache::read($this->getCacheKey($type)))) {
				return false;
			}
			return $cache;
	}
	
	/**
	 * Sends the data to the view.
	 *
	 * @param array $data
	 * @param string $type the name of the placeholder for which the data will be sent
	 * @return void
	 */
	
	private function setData($data, $type = null) {

		if ($data) {
			if (!Configure::read('Cache.disbled') && ($this->cacheExpires)) {
				$elementData['cache'] = $this->cacheExpires;
			}
			
			if (isset($this->config[$type]))
				$elementData['data'] = Set::merge($this->config[$type],$data);
			else
				$elementData['data'] = $data;
			
			if (isset($data['sequence'])) {
				 $elementData['sequence'] = $data['sequence'];
				unset($data['sequence']);
			}

			$this->controller->viewVars['placeholders'][$type][$this->name] = $elementData;
			}
	}
	
	/**
	 * Stores the data in the cache
	 * @param mixed $data
	 * @param string $type the name of the placeholder for which the cache will be stored
	 * @return boolean true on success.
	 */
	
	private function saveToCache($data, $type = null) {
		
		if (Configure::read('Cache.disbled')) {
			return false;
		}
		return Cache::write($this->getCacheKey($type),$data,$this->cacheExpires);
	}
	
	/**
	 * Whether is ok to continue processing the data (i.e fetch it and send it to the view) or not
	 * @param string $type the name of the placeholder for which the data will be sent
	 * @return boolean true if is ok to continue
	 */
	
	protected function _continue($type = null) {
		
		if (isset ($this->controller->params['requested']) ||
			(isset($this->RequestHandler) && $this->RequestHandler->isAjax())
			) {
                 	return false;
		}
		return true;
	}
	
	/**
	 * Returns the data that will be sent to the view. It must be implemented in subclasses
	 * @param string $type the type of placeholder where the data is going to be used.
	 * @param string $type the name of the placeholder for which the data will be sent
	 * @return mixed
	 */
	
	protected abstract function getData($type = null);
}
?>