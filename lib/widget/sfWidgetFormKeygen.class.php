<?php 

/**
 * A widget to render the new HTML5 "keygen"
 * 
 * Fallback:
 * Browsers not supporting HTML5 will display an empty tag (aka. "nothing")
 * 
 * 
 * @author Christian Zenker <christian.zenker@599media.de>
 */
class sfWidgetFormKeygen extends sfWidgetFormInput
{
  
  /**
   * @param  string $name        The element name
   * @param  mixed  $value      The value of the widget
   * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
   * @param  array  $errors      An array of errors for the field
   *
   * @return string An HTML tag string
   *
   * @see sfWidgetForm
   */
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
  	
    return $this->renderTag('keygen', array_merge(array('keytype' => 'rsa', 'name' => $name, 'value' => $value), $attributes));
  }
}