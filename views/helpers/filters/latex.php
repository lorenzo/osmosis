<?php
class LatexHelper extends Helper {
	var $Engine = null;

	function __construct() {
		parent::__construct();
		$this->Engine =& new LatexRemoteEngine;
	} 
	
	function filter($content) {
		$content = preg_replace_callback("#\[tex\](.*?)\[/tex\]#si",array(&$this,'replace'),$content);
		return $content;
	}
	
	function replace($match) {
		$latex_formula = html_entity_decode(strip_tags($match[1]));

        $url = $this->Engine->getFormulaURL($latex_formula);

		$alt_latex_formula = htmlentities($latex_formula, ENT_QUOTES);
		$alt_latex_formula = str_replace("\r","&#13;",$alt_latex_formula);
		$alt_latex_formula = str_replace("\n","&#10;",$alt_latex_formula);

        if ($url != false) {
            $content = "<img src='".$url."' title='".$alt_latex_formula."' alt='".$alt_latex_formula."' />";
        } else {
			//Should send an error image
		}
		return $content;
    }
}

class LatexRemoteEngine extends Object {
	
	function getFormulaURL($formula) {
		return "http://www.codecogs.com/eq.latex?".$formula;
	}
}

class LatexBuiltInEngine extends Object {
	
	var $lib = null;
	
	function __construct() {
		Configure::load('latex');
		App::import('Vendor','LatexRender');
		$renderPath =  Configure::read('Latex.renderPath');
		$tmpDir = Configure::read('Latex.renderTempDir');
		$this->lib =& LatexRender($renderPath,$this->url('/',true).'img/',$tmpDir);
		$this->lib->_latex_path = Configure::read('Latex.latexPath');
		$this->lib->_dvips_path  = Configure::read('Latex.dvipsPath');
		$this->lib->_convert_path  = Configure::read('Latex.convertPath');
		$this->lib->_identify_path  = Configure::read('Latex.identifyPath');
	}
	
	
	function getFormulaURL($formula) {
		return $this->getFormulaURL($formula);
	}
}
?>
