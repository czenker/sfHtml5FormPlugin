<?php 

/**
 * a mock form to simulate a legacy browser
 * 
 * use this to check the validators
 * 
 * @deprecated
 * @author Christian Zenker <christian.zenker@599media.de>
 */
class sfHtml5FormDemoMockForm extends sfForm {
	
	public function configure() {
		
		$this->setWidgets(array(
			'input_color' => new sfWidgetFormInputText(),
			'input_date' => new sfWidgetFormInputText(),
			'input_date_time' => new sfWidgetFormInputText(),
			'input_date_time_local' => new sfWidgetFormInputText(),
			'input_email' => new sfWidgetFormInputText(),
			'input_month' => new sfWidgetFormInputText(),
			'input_week' => new sfWidgetFormInputText(),
			'input_number' => new sfWidgetFormInputText(),
			'input_range' => new sfWidgetFormInputText(),
			'input_search' => new sfWidgetFormInputText(),
			'input_tel' => new sfWidgetFormInputText(),
			'input_time' => new sfWidgetFormInputText(),
			'input_url' => new sfWidgetFormInputText(),
		));
		
		$this->widgetSchema->setNameFormat('sf_html5_form_demo_mock[%s]');
		$this->widgetSchema->setFormFormatterName('table');
		
	}
}