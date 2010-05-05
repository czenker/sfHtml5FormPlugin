<?php 

/**
 * A widget to render the new HTML5 input-type "email"
 * 
 * Fallback:
 * Browsers not supporting HTML5 will display input-type "text"
 * 
 * 
 * @author Christian Zenker <christian.zenker@599media.de>
 */
class sfWidgetFormInputEmail extends sfWidgetFormInput
{
  
  /**
   * Available options:
   *
   *  * multiple:                If multiple email-addresses are allowed (default: false)
   * 
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetForm
   */
  protected function configure($options = array(), $attributes = array())
  {
    parent::configure($options, $attributes);
    
    $this->addOption('multiple', false);
    
    $this->setOption('type', 'email');
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
  	if($this->getOption('multiple')) {
  		$attributes['multiple'] = 'multiple';
  		if(is_array($value)) {
  			$value = implode(',', $value);
  		}
  	}
  	
  	return parent::render($name, $value, $attributes, $errors);
  }
}