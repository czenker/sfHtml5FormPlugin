<?php 

/**
 * validates a value to be a #rrggbb-style color value
 * 
 * @see http://dev.w3.org/html5/markup/datatypes.html#form.data.color
 * @author Christian Zenker <christian.zenker@599media.de>
 */
class sfValidator5Color extends sfValidatorBase {
	
  /**
   * Configures the current validator.
   *
   * Available options:
   *
   *  * trim_sharp: If the leading # sharp on the return value should be stripped (default: false)
   *
   * @param array $options   An array of options
   * @param array $messages  An array of error messages
   *
   * @see sfValidatorBase
   */
	public function configure($options = array(), $messages = array()) {
		$this->addOption('trim_sharp', false);
		
		$this->setMessage('invalid', 'The color is invalid, use the #rrggbb-format');
	}
	
  /**
   * @see sfValidatorBase
   */
	public function doClean($value) {
		
		if(preg_match('/^#[0-9a-f]{6}$/i', $value) == 0) {
			throw new sfValidatorError($this, 'invalid');
		}
		
		return $this->getOption('trim_sharp') ? ltrim('#', $value) : $value;
	}
	
}