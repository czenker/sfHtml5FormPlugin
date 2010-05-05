<?php 

/**
 * validates a value to be a date send by the input-type "date"
 * 
 * @author Christian Zenker <christian.zenker@599media.de>
 */
class sfValidator5Date extends sfValidatorDate {
	
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
		
		$this->setOption('date_format', sfWidgetFormInputDate::getRegexp());
		$this->setOption('date_format_error', sfWidgetFormInputDate::getDateFormat());
	}
	
/**
   * Converts an array representing a date to a timestamp.
   *
   * The array can contains the following keys: year, month, day, hour, minute, second
   *
   * @param  array $value  An array of date elements
   *
   * @return int A timestamp
   */
  protected function convertDateArrayToString($value)
  {
  	/**
  	 * The (original) date validator was written to convert three or six single
  	 * input boxes to one date.
  	 * 
  	 * We don't want that here, so we will take the value and convert it on our own, 
  	 * if it seems to be a value submitted by our imput->date.
  	 */
  	
  	if(array_key_exists(0, $value)) {
  		//our value comes from the preg_match matches field
  		return $this->convertPregDateToString($value);
  	}
  	
  	return parent::convertDateArrayToString($value);
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
  	 */
  	return sprintf(
  		'%04d-%02d-%02d %02d:%02d:%02d',
  		$value[1],
  		$value[2],
  		$value[3],
  		0,
  		0,
  		0
  	);
  }
  
}