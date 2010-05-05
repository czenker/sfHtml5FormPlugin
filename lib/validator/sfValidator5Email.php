<?php 

/**
 * validates a value to be an email address or a list of them
 * 
 * @author Christian Zenker <christian.zenker@599media.de>
 */
class sfValidator5Email extends sfValidatorEmail {
	
  /**
   * Configures the current validator.
   *
   * Available options:
   *
   *  * multiple: If multiple email addresses are allowed (default: false)
   *
   *  
   * @param array $options   An array of options
   * @param array $messages  An array of error messages
   *
   * @see sfValidatorBase
   */
	public function configure($options = array(), $messages = array()) {
		parent::configure($options, $messages);
		$this->addOption('multiple', false);
	}
	
  /**
   * @see sfValidatorBase
   */
	public function doClean($value) {
		if($this->getOption('multiple') === false) {
			return parent::doClean($value);
		}
		
		$value = explode(',', $value);
		foreach ($value as $key => $email) {
			$value[$key] = parent::doClean($email);
		} 
		
		return $value;
	}
	
}