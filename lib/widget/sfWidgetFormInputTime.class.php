<?php 

/**
 * A widget to render the new HTML5 input-type "time"
 * 
 * Fallback:
 * Browsers not supporting HTML5 will display input-type "text"
 * 
 * 
 * @author Christian Zenker <christian.zenker@599media.de>
 */
class sfWidgetFormInputTime extends sfWidgetFormInputDate
{

  /**
   * Available options:
   *
   *  * max:                     The maximum time allowed (as a timestamp, DateTime or hh:ii:ss format)
   *  * min:                     The minimum time allowed (as a timestamp, DateTime or hh:ii:ss format)
   * 
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetForm
   */
  protected function configure($options = array(), $attributes = array())
  {
    parent::configure($options, $attributes);
    
    $this->setOption('type', 'time');
  }

  /**
   * @see sfWidgetFormInputDate
   */
  public static function getRegexp() {
  	return sprintf('/^%s:%s:%s(%s)?$/', self::$exp['time-hour'], self::$exp['time-minute'], self::$exp['time-second'], self::$exp['time-secfrac']);
  }
  
  /**
   * @see sfWidgetFormInputDate
   */
  public static function getDateFormat() {
  	return 'H:i:s.u';
  }
}