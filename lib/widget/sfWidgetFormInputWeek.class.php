<?php 

/**
 * A widget to render the new HTML5 input-type "week"
 * 
 * Fallback:
 * Browsers not supporting HTML5 will display input-type "text"
 * 
 * 
 * @author Christian Zenker <christian.zenker@599media.de>
 */
class sfWidgetFormInputWeek extends sfWidgetFormInputDate
{

  /**
   * Available options:
   *
   *  * max:                     The maximum week allowed (as a timestamp, DateTime or yyyy-Www format)
   *  * min:                     The minimum week allowed (as a timestamp, DateTime or yyyy-Www format)
   * 
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetForm
   */
  protected function configure($options = array(), $attributes = array())
  {
    parent::configure($options, $attributes);
    
    $this->setOption('type', 'week');
  }

  /**
   * @see sfWidgetFormInputDate
   */
  public static function getRegexp() {
    return sprintf('/^%s-W%s?$/', self::$exp['date-fullyear'], self::$exp['date-week']);
  }
  
  /**
   * @see sfWidgetFormInputDate
   */
  public static function getDateFormat() {
    return 'Y-\WW';
  }
}