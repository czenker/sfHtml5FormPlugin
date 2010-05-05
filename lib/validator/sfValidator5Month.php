<?php 

/**
 * validates a value to be a month send by the input-type "month"
 * returns the first day of the selected month by default
 * 
 * @author Christian Zenker <christian.zenker@599media.de>
 */
class sfValidator5Month extends sfValidator5Date {
	
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
		
		$this->setOption('date_format', sfWidgetFormInputMonth::getRegexp());
		$this->setOption('date_format_error', sfWidgetFormInputMonth::getDateFormat());
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
  	 */
  	return sprintf(
  		'%04d-%02d-%02d %02d:%02d:%02d',
  		$value[1],
  		$value[2],
  		1,
  		0,
  		0,
  		0
  	);
  }
  
}