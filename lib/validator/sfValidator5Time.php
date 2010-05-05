<?php 

/**
 * validates a value to be a week send by the input-type "time"
 * strips microseconds
 * 
 * @author Christian Zenker <christian.zenker@599media.de>
 */
class sfValidator5Time extends sfValidator5Date {
	
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
		
		$this->setOption('date_format', sfWidgetFormInputTime::getRegexp());
		$this->setOption('with_time', true);
		$this->setOption('datetime_output', 'H:i:s');
	}
  
  /**
   * converts an array from preg_match to a string
   * 
   * @param array $value
   * @return string
   */
  protected function convertPregDateToString($value) {
  	/**
  	 * 1 => hour
  	 * 2 => minute
  	 * 3 => second
  	 */

  	return sprintf(
  		'%04d-%02d-%02d %02d:%02d:%02d',
  		1960,
  		1,
  		1,
  		$value[1],
  		$value[2],
  		$value[3]
  	);
  }
  
}