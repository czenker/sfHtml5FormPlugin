<?php 

/**
 * validates a value to be a dateTime send by the input-type "datetime"
 * ingnores microseconds on the value
 * 
 * @author Christian Zenker <christian.zenker@599media.de>
 */
class sfValidator5DateTime extends sfValidator5Date {
	
  /**
   * Configures the current validator.
   *
   * @param array $options   An array of options
   * @param array $messages  An array of error messages
   *
   * @see sfValidatorBase
   */
	public function configure($options = array(), $messages = array()) {
		parent::configure($options, $messages);
		
		$this->setOption('date_format', sfWidgetFormInputDateTime::getRegexp());
		$this->setOption('date_format_error', sfWidgetFormInputDateTime::getDateFormat());
		$this->setOption('with_time', true);
	}
  
  /**
   * converts an array from preg_match to a string
   * 
   * @param array $value
   * @return string
   */
  protected function convertPregDateToString($value) {
  	/**
  	 * 1 => year
  	 * 2 => month
  	 * 3 => day
  	 * 4 => hour
  	 * 5 => minute
  	 * 6 => second
  	 * 7 => microsecond or null
  	 * 8 => timezone
  	 */
  	return sprintf(
  		'%04d-%02d-%02d %02d:%02d:%02d%s',
  		$value[1],
  		$value[2],
  		$value[3],
  		$value[4],
  		$value[5],
  		$value[6],
  		$value[8] == 'Z' ? '' : $value[8]
  	);
  }
  
}