<?php
class FilterHelper extends Helper {
	
	var $helpers = array('Html');
	var $filters = null;
	
	function _initFilters() {
		$filters = Configure::listObjects('helper',HELPERS.'filters');
		foreach ($filters as $name) {
			if(App::import('File',$name,true,HELPERS.'filters')) {
				$this->filters[] = $name;
				$clasName = $name.'Helper';
				$this->{$name} =& new $clasName;
				$this->{$name}->Filter =& $this;
			}
		}
	}
	
	function filter($content) {
		if ($this->filters == null) {
			$this->_initFilters();
		}
		
		foreach ($this->filters as $filter) {
			$content = $this->{$filter}->filter($content);
		}
		
		return $content;
	}
	
}
?>
