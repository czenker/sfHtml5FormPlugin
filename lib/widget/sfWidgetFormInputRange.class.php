<?php 

/**
 * A widget to render the new HTML5 input-type "range"
 * 
 * Fallback:
 * Browsers not supporting HTML5 will display input-type "text"
 * 
 * 
 * @author Christian Zenker <christian.zenker@599media.de>
 */
class sfWidgetFormInputRange extends sfWidgetFormInputNumber
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
    
    $this->setOption('type', 'range');
  }

}