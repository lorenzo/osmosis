<?php
/* SVN FILE: $Id$ */
/**
 * Ósmosis LMS: <http://www.osmosislms.org/>
 * Copyright 2008, Ósmosis LMS
 *
 * This file is part of Ósmosis LMS.
 * Ósmosis LMS is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Ósmosis LMS is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Ósmosis LMS.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @filesource
 * @copyright		Copyright 2008, Ósmosis LMS
 * @link			http://www.osmosislms.org/
 * @package			org.osmosislms
 * @subpackage		org.osmosislms.app
 * @since			Version 2.0 
 * @version			$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 * @license			http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License Version 3
 */
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
		$method = Inflector::variable($type);
		if (!$data && method_exists($this, $method)) {
			$data = $this->{$method}();
		}
		if ($data === false)
			return;
		$this->saveToCache($data, $type);
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

		if ($data!==false) {
			if (!$this->cache) {
				$elementData['cache'] = false;
			} else if (!Configure::read('Cache.disabled') && $this->cacheExpires) {
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
		return !isset ($this->controller->params['requested']) &&
				!$this->RequestHandler->isAjax();
	}
}
?>
