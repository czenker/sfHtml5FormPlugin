<?php 

/**
 * A widget to render the new HTML5 input-type "date"
 * 
 * Fallback:
 * Browsers not supporting HTML5 will display input-type "text"
 * 
 * 
 * @author Christian Zenker <christian.zenker@599media.de>
 */
class sfWidgetFormInputDate extends sfWidgetFormInput
{

  /**
   * a set of fragments to be used in preg-match to validate a correct date
   *  
   * @var array
   */
  protected static $exp = array(
    'date-fullyear' => '(\d{4,})',
    'date-month' => '(0\d|1[0-2])',
    'date-mday' => '([0-2]\d|3[0-1])',
    'time-hour' => '([0-1]\d|2[0-3])',
  	'time-minute' => '([0-5]\d)',
  	'time-second' => '([0-5]\d|60)',
    'time-secfrac' => '(\.\d+)',
  	'time-offset' => '(Z|[-+](?:[0-1]\d|2[0-3]):[0-5]\d)', // copied: time-hour,time-minute
  	'date-week' => '([0-4]\d|5[0-3])',
  );
  
  /**
   * Available options:
   *
   *  * max:                     The maximum date allowed (as a timestamp, DateTime or yyyy-mm-dd format)
   *  * min:                     The minimum date allowed (as a timestamp, DateTime or yyyy-mm-dd format)
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
    
    $this->setOption('type', 'date');
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
  	if($this->getOption('min')) {
  		$attributes['min'] = $this->formatDate($this->getOption('min'));
  	}
    if($this->getOption('max')) {
  		$attributes['max'] = $this->formatDate($this->getOption('max'));
  	}
  	
    if($value) {
    	try {
  			$value = $this->formatDate($value);
    	}
    	catch(InvalidArgumentException $e) {
    		/*
    		 * this exception is usually thrown if a HTML4 user inserts a date manually
    		 * but has a malicious form
    		 * we'll just ignore it and echo what the user entered
    		 */
    	}
  	}
  	
  	return parent::render($name, $value, $attributes, $errors);
  }
  
  /**
   * format an input date to a valid output date
   * 
   * @param string|DateTime|integer $unformated
   * @return string
   */
  public function formatDate($unformated) {
    if(is_string($unformated)) {
    	if(preg_match($this->getRegexp(), $unformated) > 0) {
	      //if: string in correct form
	      return $unformated;
    	}
    	$temp = strtotime($unformated);
    	if($temp !== false) {
    		$unformated = $temp;
    	} 
    }
    if(is_integer($unformated)) {
      //else: unix timestamp
      return date($this->getDateFormat(), $unformated);
    }
    if(is_object($unformated) && $unformated instanceof DateTime) {
      //else: date-time-object
      return $unformated->format($this->getDateFormat());
    }
    
    throw new InvalidArgumentException(sprintf('The unformated date must be a unix-timestamp, DateTime or in %s format.', $this->getDateFormat()));
  }
  
  /**
   * get the regexp a date must match to be a HTML5-valid value for one of
   * the attributes value, min, max
   * 
   * @return string
   */
  public static function getRegexp() {
  	return sprintf('/^%s-%s-%s$/', self::$exp['date-fullyear'], self::$exp['date-month'], self::$exp['date-mday']);
  }
  
  /**
   * get the date() format to render a unixtimestamp or DateTime to be a HTML5-valid
   * value for one of the attributes value, min, max
   * 
   * @return string
   */
  public static function getDateFormat() {
  	return 'Y-m-d';
  }
}