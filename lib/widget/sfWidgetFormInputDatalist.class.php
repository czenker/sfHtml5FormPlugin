<?php

/**
 * A widget to render an input type "text" with an additional datalist
 *
 * Fallback:
 * Browsers not supporting HTML5 will display input-type "text" without any hinting
 *
 *
 * @author Christian Zenker <christian.zenker@599media.de>
 */
class sfWidgetFormInputDatalist extends sfWidgetFormInput {

	/**
	 * * Available options:
	 *
	 *  * choices:                 array of values that should be proposed
	 *  * choices_url:             if set, the recommendations are loaded dynamically via AJAX (default: null)
	 *  * choices_url_param:       the param name for the query (default: 'q')
	 *  * datalist_id:             the attribute "id" the datalist-tag should be assigned (default: null)
	 *
	 * @param array $options     An array of options
	 * @param array $attributes  An array of default HTML attributes
	 *
	 * @see sfWidgetForm
	 */
	protected function configure($options = array(), $attributes = array()) {
		parent::configure($options, $attributes);
		$this->addOption('choices', array());
		$this->addOption('choices_url', null);
		$this->addOption('choices_url_param', 'q');
		$this->addOption('datalist_id', null);
	}

	public function render($name, $value = null, $attributes = array(), $errors = array()) {
		$datalist_id = $this->getOption('datalist_id') ? $this->getOption('datalist_id') : $this->generateId($name).'_datalist';

		if(!is_null($this->getOption('choices_url'))) {
			$attributes = array_merge(
				array(
					'oninput' => sprintf(
						"list.data = '%s?%s=' + encodeURIComponent(value)",
						$this->getOption('choices_url'),
						$this->getOption('choices_url_param')
					)
				),
				$attributes
			);
		}
		
		$attributes = array_merge(
			array('list' => $datalist_id),
			$attributes
		);

		$input = parent::render($name, $value, $attributes, $errors);

		$list = $this->renderDataList($datalist_id, $this->getOption('choices'), $name);
		return $input.$list;
	}

	/**
	 * render the datalist tag and its content
	 *
	 * @param string $id
	 * @param array $choices
	 * @param string $name
	 * @return string
	 */
	public function renderDataList($id, $choices, $name = '') {
		$options = array();
		foreach($choices as $value) {
			$options[] = $this->renderTag('option', array('value' => $value));
		}
		return sprintf(
			'<datalist id="%s">%s</datalist>',
			$id,
			implode("\n", $options)
		);
	}
	
/**
   * Prepares an attribute key and value for HTML representation.
   *
   * It removes empty attributes, except for the value one.
   *
   * @param  string $k  The attribute key
   * @param  string $v  The attribute value
   *
   * @return string The HTML representation of the HTML key attribute pair.
   */
	protected function attributesToHtmlCallback($k, $v) {
    	return false === $v || null === $v || ('' === $v && 'value' != $k) ? '' : sprintf(' %s="%s"', $k, $k === 'oninput' ? $v : $this->escapeOnce($v));
	}
}