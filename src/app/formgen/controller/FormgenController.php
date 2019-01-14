<?php
namespace formgen\controller;

use n2n\web\http\controller\ControllerAdapter;
use n2n\web\http\controller\ParamQuery;
use formgen\model\FormgenDao;
use n2n\web\http\PageNotFoundException;
use formgen\model\FormgenDynamicForm;
use n2n\web\http\Request;

class FormgenController extends ControllerAdapter {
	const PATH = 'fgpost';
	
	public function index(Request $request, FormgenDao $formgenDao, ParamQuery $f) {
		$dynamicForm = $formgenDao->getDynamicFormById((string) $f);
		if (null === $dynamicForm) {
			throw new PageNotFoundException('Invalid form id ' . $f);
		}
		
		$formgenDynamicForm = new FormgenDynamicForm($request->getN2nLocale(), $dynamicForm);
		if ($this->dispatch($formgenDynamicForm, 'send')) {
			$this->redirectToController(array('thanks'), array('f' => $dynamicForm->getId()));
			return;
		}
		
		$this->forward('..\view\dynamicForm.html', array('formgenDynamicForm' => $formgenDynamicForm));
	}
	
	public function doThanks(FormgenDao $formgenDao, ParamQuery $f) {
		$dynamicForm = $formgenDao->getDynamicFormById((string) $f);
		if (null === $dynamicForm) {
			throw new PageNotFoundException('Invalid form id ' . $f);
		}
		
		$this->forward('..\view\dynamicFormThanks.html', array('dynamicForm' => $dynamicForm));
	}
}