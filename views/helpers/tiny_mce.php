<?php
class TinyMceHelper extends Helper {

	var $helpers = array('Html','Javascript');
	var $defaults = array(
		'mode' => "textareas",
		'theme' => "advanced",
		'skin' => "osmosis",
		'plugins' => "safari,table,save,inlinepopups,preview,media,contextmenu,paste,fullscreen,noneditable,visualchars,xhtmlxtras,noneditable,latex",
		'theme_advanced_buttons1' => "save,preview,|,cut,copy,paste,pasteword,|,undo,redo,|,link,unlink,|,image,media,|,removeformat,code,fullscreen",
		'theme_advanced_buttons2' => "bold,italic,underline,|,justifyleft,justifyfull,|,bullist,numlist,|,blockquote,formatselect,|,charmap,latex",
		'theme_advanced_buttons3' => "",
		'theme_advanced_toolbar_location' => "bottom",
		'theme_advanced_toolbar_align' => "left",
		'theme_advanced_statusbar_location' => "bottom",
		'theme_advanced_resizing' => true,
		'media_types' => 'flash',
		'convert_urls'=> false,
		'gecko_spellcheck' => true
	);

	function _mergeTinymcePlugins(&$options) {
		if (isset($options['plugins'])){
			$plugins = $options['plugins'];
			foreach ($plugins as $name => $settings) {
				$this->defaults['plugins'] .= ',' . $name;
				foreach ($settings as $setting_name => $setting_value) {
					$this->defaults[$setting_name] = $setting_value;
				}
			}
			unset($options['plugins']);
		}
	}

	function _mergeTinymceButtons($field, &$options) {
		if (isset($this->defaults[$field]) && !empty($options[$field])) {
			$field_values = $options[$field];
			if (is_array($field_values)) {
				if (in_array('reset', $field_values)) {
					$this->defaults[$field] = '';
				}
				$field_values = implode(',', $field_values);
				$field_values = str_replace(',reset', ',', $field_values);
			}
			$this->defaults[$field] .= ',' . $field_values;
			unset($options[$field]);
		}
	}

	function _mergeOptions($options) {
		$this->_mergeTinymcePlugins($options);
		$this->_mergeTinymceButtons('theme_advanced_buttons1', $options);
		$this->_mergeTinymceButtons('theme_advanced_buttons2', $options);
		$this->_mergeTinymceButtons('theme_advanced_buttons3', $options);
		if (!empty($options)) {
			$options  = array_merge($this->defaults,$options);
		} else
			$options = $this->defaults;
		return $options;
	}

	function widget($options = array()) {
		$options = $this->_mergeOptions($options);
		return 'tinyMCE.init('.$this->Javascript->object($options).')';
	}

}
?>