<?php 

/**
 * A widget to render the new HTML5 input-type "number"
 * 
 * Fallback:
 * Browsers not supporting HTML5 will display input-type "text"
 * 
 * 
 * @author Christian Zenker <christian.zenker@599media.de>
 */
class sfWidgetFormInputNumber extends sfWidgetFormInput
{
  
  /**
   * Available options:
   *
   *  * max:                     The maximum value allowed
   *  * min:                     The minimum value allowed
   *  * int:                     If the selected value should be an integer (default: false)
   * 
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetForm
   */
  protected function configure($options = array(), $attributes = array())
  {
    parent::configure($options, $attributes);
    
    $this->addOption('min', null);
    $this->addOption('max', null);
    $this->addOption('int', false);
    
    $this->setOption('type', 'number');
  }
  
   /**
   * @param  string $name        The element name
   * @param  string $value       The value displayed in this widget
   * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
   * @param  array  $errors      An array of errors for the field
   *
   * @return string An HTML tag string
   *
   * @see sfWidgetForm
   */
  public function render($name, $value = null, $attributes = array(), $errors = array()) {
  	if($this->getOption('int')) {
  		if(!is_null($this->getOption('min'))) {
  			$attributes['min'] = intval(ceil($this->getOption('min')));
  		}
  		if(!is_null($this->getOption('max'))) {
  			$attributes['max'] = intval(floor($this->getOption('max')));
  		}
  		if(!is_null($value)) {
  			$value = intval(round($value));
  		}
  		$attributes['step'] = isset($attributes['step']) ? intval(round($attributes['step'])) : 1;
  	} else {
  		if(!is_null($this->getOption('min'))) {
  			$attributes['min'] = floatval($this->getOption('min'));
  		}
  		if(!is_null($this->getOption('max'))) {
  			$attributes['max'] = floatval($this->getOption('max'));
  		}
  		if(!is_null($value)) {
  			$value = floatval($value);
  		}
  	}
  	
  	return parent::render($name, $value, $attributes, $errors);
  }
}