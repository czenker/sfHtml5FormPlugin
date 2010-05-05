<?php

include_once(dirname(__FILE__).'/../lib/form/sfHtml5FormDemoForm.php');

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Christian Zenker <christian.zenker@599media.de>
 */
class sfHtml5FormDemoActions extends sfActions {
	
	public function executeIndex(sfWebRequest $request) {
		
		$this->form = new sfHtml5FormDemoForm();
		
		$this->formMock = new sfHtml5FormDemoMockForm();
		
		
		if($request->getMethod() == 'POST') {
			if($request->hasParameter($this->form->getName())) {
				
				$this->params = $request->getParameter($this->form->getName());
				$this->form->bind(
					$request->getParameter($this->form->getName())
				);
				if($this->form->isValid()) {
					$this->getUser()->setFlash('ok', 'Form is valid.');
				} else {
					$this->getUser()->setFlash('error', 'Form is invalid.');
				}
			}
			if($request->hasParameter($this->formMock->getName())) {
				var_dump($request->getParameter($this->formMock->getName()));
			}
			
		}
	}
}
