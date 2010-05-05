<?php 

/**
 * A widget to render the new HTML5 input-type "datetime-local"
 * 
 * Fallback:
 * Browsers not supporting HTML5 will display input-type "text"
 * 
 * 
 * @author Christian Zenker <christian.zenker@599media.de>
 */
class sfWidgetFormInputDateTimeLocal extends sfWidgetFormInputDate
{

  /**
   * Available options:
   *
   *  * max:                     The maximum date allowed (as a timestamp, DateTime or yyyy-mm-ddThh:ii:ss format)
   *  * min:                     The minimum date allowed (as a timestamp, DateTime or yyyy-mm-ddThh:ii:ss format)
   * 
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetForm
   */
  protected function configure($options = array(), $attributes = array())
  {
    parent::configure($options, $attributes);
    
    $this->setOption('type', 'datetime-local');
  }

  /**
   * @see sfWidgetFormInputDate
   */
  public static function getRegexp() {
  	return sprintf('/^%s-%s-%sT%s:%s(?::%s)?%s?$/', self::$exp['date-fullyear'], self::$exp['date-month'], self::$exp['date-mday'], self::$exp['time-hour'], self::$exp['time-minute'], self::$exp['time-second'], self::$exp['time-secfrac']);
  }
  
  /**
   * @see sfWidgetFormInputDate
   */
  public static function getDateFormat() {
  	return 'Y-m-d\TH:i:s.u';
  }
}