<?php 

class sfHtml5FormDemoForm extends sfForm {
	
	public function configure() {
		
		$now = time();
		
		$this->setWidgets(array(
			'input_color' => new sfWidgetFormInputColor(),
			'input_date' => new sfWidgetFormInputDate(),
			'input_date_limits' => new sfWidgetFormInputDate(array(
				'min' => $now,
				'max' => $now + 30*86400
			)),
			'input_date_step' => new sfWidgetFormInputDate(array(), array(
				'step' => 7
			)),
			'input_date_time' => new sfWidgetFormInputDateTime(),
			'input_date_time_limits' => new sfWidgetFormInputDateTime(array(
				'min' => $now,
				'max' => $now + 30*86400
			)),
			'input_date_time_step' => new sfWidgetFormInputDateTime(array(), array(
				'step' => 3600
			)),
			'input_date_time_local' => new sfWidgetFormInputDateTimeLocal(),
			'input_date_time_local_limits' => new sfWidgetFormInputDateTimeLocal(array(
				'min' => $now,
				'max' => $now + 30*86400
			)),
			'input_date_time_local_step' => new sfWidgetFormInputDateTimeLocal(array(), array(
				'step' => 3600
			)),
			'input_email' => new sfWidgetFormInputEmail(),
			'input_email_multiple' => new sfWidgetFormInputEmail(array(
				'multiple' => true
			)),
			'input_month' => new sfWidgetFormInputMonth(),
			'input_month_limit' => new sfWidgetFormInputMonth(array(
				'min' => $now,
				'max' => $now + 12*30*86400
			)),
			'input_month_step' => new sfWidgetFormInputMonth(array(), array(
				'step' => 12
			)),
			'input_week' => new sfWidgetFormInputWeek(),
			'input_week_limit' => new sfWidgetFormInputWeek(array(
				'min' => $now,
				'max' => $now + 12*30*86400
			)),
			'input_week_step' => new sfWidgetFormInputWeek(array(), array(
				'step' => 2
			)),
			'input_number' => new sfWidgetFormInputNumber(),
			'input_number_limit' => new sfWidgetFormInputNumber(array(
				'min' => 0,
				'max' => 100
			)),
			'input_number_step' => new sfWidgetFormInputNumber(array(), array(
				'step' => 0.01
			)),
			'input_range' => new sfWidgetFormInputRange(),
			'input_range_limit' => new sfWidgetFormInputRange(array(
				'min' => -50,
				'max' => 50
			)),
			'input_search' => new sfWidgetFormInputSearch(),
			'input_tel' => new sfWidgetFormInputTel(),
			'input_time' => new sfWidgetFormInputTime(),
			'input_time_limit' => new sfWidgetFormInputTime(array(
				'min' => 8*3600,
				'max' => 17*3600
			)),
			'input_time_step' => new sfWidgetFormInputTime(array(), array(
				'step' => 3600
			)),
			'input_url' => new sfWidgetFormInputUrl(),
			'keygen' => new sfWidgetFormKeygen(),
		));
		
		$this->widgetSchema->setHelps(array(
			'input_color' => '',
			'input_date' => '',
			'input_date_limits' => 'date between now and now+30 days',
			'input_date_step' => 'only select days that have todays weekday',
			'input_date_time' => '',
			'input_date_time_limits' => 'date between now and now+30 days',
			'input_date_time_step' => 'only select by hours',
			'input_date_time_local' => '',
			'input_date_time_local_limits' => 'date between now and now+30 days',
			'input_date_time_local_step' => 'only select by hours',
			'input_email' => '',
			'input_email_multiple' => 'allow multiple email addresses',
			'input_month' => '',
			'input_month_limit' => 'months between now and now+1 year',
			'input_month_step' => 'the current month in any year',
			'input_week' => '',
			'input_week_limit' => 'weeks between now and now+1 year',
			'input_week_step' => 'every second week',
			'input_number' => '',
			'input_number_limit' => 'values between 0 and 100',
			'input_number_step' => 'float values with step 0.01',
			'input_range' => '',
			'input_range_limit' => 'value between -50 and 50',
			'input_search' => '',
			'input_tel' => '',
			'input_time' => '',
			'input_time_limit' => 'time between 9am and 6pm',
			'input_time_step' => 'full hours',
			'input_url' => '',
			'keygen' => '',
		));
		
		$this->setValidators(array(
			'input_color' => new sfValidator5Color(),
			'input_date' => new sfValidator5Date(array(
				'min' => $now-3600
			)),
			'input_date_time' => new sfValidator5DateTime(array(
				'required' => false,
				'max' => $now
			)),
			'input_date_time_local' => new sfValidator5DateTimeLocal(),
			'input_email' => new sfValidator5Email(array(
				'multiple' => true
			)),
			'input_month' => new sfValidator5Month(),
			'input_week' => new sfValidatorPass(), //TODO: we need a validator
			'input_number' => new sfValidatorNumber(),
			'input_range' => new sfValidatorNumber(array(
				'min' => 0,
				'max' => 100
			)),
			'input_search' => new sfValidatorString(),
			'input_tel' => new sfValidatorString(),
			'input_time' => new sfValidator5Time(),
			'input_url' => new sfValidatorUrl(),
			'keygen' => new sfValidatorPass(), //TODO: we need a validator
		));
		
		foreach($this->validatorSchema->getFields() as $validator) {
			$validator->setOption('required', false);
		}
		
		$this->widgetSchema->setNameFormat('sf_html5_form_demo[%s]');
		$this->widgetSchema->setFormFormatterName('table');
		
	}
}


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