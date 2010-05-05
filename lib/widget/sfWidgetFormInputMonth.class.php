<?php 

/**
 * A widget to render the new HTML5 input-type "month"
 * 
 * Fallback:
 * Browsers not supporting HTML5 will display input-type "text"
 * 
 * 
 * @author Christian Zenker <christian.zenker@599media.de>
 */
class sfWidgetFormInputMonth extends sfWidgetFormInputDate
{

  /**
   * Available options:
   *
   *  * max:                     The maximum date allowed (as a timestamp, DateTime or yyyy-mm format)
   *  * min:                     The minimum date allowed (as a timestamp, DateTime or yyyy-mm format)
   * 
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetForm
   */
  protected function configure($options = array(), $attributes = array())
  {
    parent::configure($options, $attributes);
    
    $this->setOption('type', 'month');
  }

  /**
   * @see sfWidgetFormInputDate
   */
  public static function getRegexp() {
  	return sprintf('/^%s-%s$/', self::$exp['date-fullyear'], self::$exp['date-month']);
  }
  
  /**
   * @see sfWidgetFormInputDate
   */
  public static function getDateFormat() {
  	return 'Y-m';
  }
}