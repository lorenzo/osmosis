<?php
class RatingHelper extends Helper {
	var $helpers = array('Javascript','Form','Html');
	
	/**
	 * Add necessary scripts and css to the page head
	 */
	
	function beforeRender() {
		$this->Javascript->link('jquery/plugins/jquery.rating',false);
		$this->Javascript->link('jquery/plugins/jquery.MetaData',false);
		$this->Html->css('jquery.rating',null,null,false);
	}
	
	/**
	 * Renders a new rating widget
	 *
	 * @param string $field Model field that holds rating
	 * @param array $options optios for this widget:
	 * 	  - max : Maximum rating
	 * 	  - legend : Text for legend
	 * 	  - split : Fractional step for rating, (i.e if 2 the it will split the star in two parts)
	 * 	  - Any other option accepted by FormHelper::input
	 * @param boolea $auto if automatically convert with javascript the radio inputs
	 * @return string
	 */
	
	function input($field,$options = array(),$auto = true) {
		$max = 5;
		$split = null;
		$fractions = array();
		$this->setEntity($field);
		
		if (isset($options['legend'])) {
			$legend = $options['legend'];
			unset($options['legend']);
		} else {
			$legend = __(Inflector::humanize($this->field()), true);
		}
		
		if (isset($options['split'])) {
			$split = ' {split:'.$options['split'].'}';
			$fractions = range(1,$options['split']);
			unset($options['split']);
		}
		
		if (isset($options['max'])) {
			$max = $options['max'];
			unset($options['max']);
		}
		
		foreach(range(1,$max) as $i) {
			$range[$i.''] = $i;
			if ($i==$max) break;
			foreach ($fractions as $x => $f) {
				$fraction = (1/count($fractions)); 
				if ($i == 1)
					$range[substr(($x+1)*$fraction,0,3)] = substr(($x+1)*$fraction,0,3);
					
				$range[substr($i + ($x+1)*$fraction,0,3)] = substr($i + ($x+1)*$fraction,0,3);
			}
		}
		ksort($range);

		$defaults =  array(
			'type' => 'radio',
			'options' => $range,
			'class' => 'rating'.$split,
			'legend' => false
			);
		$attributes =  am($defaults,$options);
		
		if (isset($this->data[$this->Form->model()][$field])) {
			$model = $this->Form->model();
			$low = floor($this->data[$model][$field]);
			$step = max(1,count($fractions));
			$value = $low;
			while($value <= $this->data[$model][$field]) {
					$value += 1/$step;
			}
			if ($value > $this->data[$model][$field])
				$value -= 1/$step;
			
			$value = substr($value,0,3);

			if (isset($this->Form->fieldset['fields'][$this->field()])) {
				if ($this->Form->fieldset['fields'][$this->field()]['type'] == 'float') {
					$this->Form->data[$model][$field] = $value;
					}
				else
					$this->Form->data[$model][$field] = round($this->data[$model][$field]);
			}
				
			if (isset($this->Form->fieldset['fields'][$model][$this->field()])) {
			 	if ($this->Form->fieldset['fields'][$model][$this->field()]['type'] == 'float')
					$this->Form->fieldset['fields'][$model][$this->field()]['type'] =  $value;
				else
					$this->Form->fieldset['fields'][$model][$this->field()]['type'] =  round($this->data[$model][$field]);
			}	
		}
		
		$fields = $this->Form->input($field,$attributes);
		$output = sprintf($this->Html->tags['fieldset'],' class="rating"',sprintf($this->Html->tags['legend'], $legend) .$fields);
		if ($auto) {
			$output .= $this->convertInputs();
		}
		return $this->output($output);	
	}
	
	/**
	 * Converts the selected elements to a ratig-star widget
	 *
	 * @param string $selector 
	 * @return string
	 */
	
	function convertInputs($selector = null) {
		if (!$selector) {
			$selector = 'input[@type=radio].rating';
		}
		$code = "$(document).ready(function(){ 
				$('$selector').parents('div.input.radio').find('label').remove();
				$('$selector').rating();
			});";
		return $this->Javascript->codeBlock($code);
	}
	
	
}
?>
