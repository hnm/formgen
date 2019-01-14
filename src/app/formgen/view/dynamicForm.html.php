<?php
	use n2n\impl\web\ui\view\html\HtmlView;
	use formgen\model\FormgenConfig;
	use formgen\model\FormgenDynamicForm;
	
	$view = HtmlView::view($view);
	$html = HtmlView::html($view);
	
	$formgenDynamicForm = $view->getParam('formgenDynamicForm');
	$view->assert($formgenDynamicForm instanceof FormgenDynamicForm);
	
	$dynamicForm = $formgenDynamicForm->getDynamicForm();
	
	$formgenConfig = $view->lookup(FormgenConfig::class);
	$view->assert($formgenConfig instanceof FormgenConfig);
	
	$view->useTemplate($formgenConfig->getTemplateViewId(), 
			array('title' => $dynamicForm->t($view->getN2nLocale())->getTitle(), 'dynamicForm' => $dynamicForm));
?>
<?php $view->import('inc\dynamicFormPart.html', array('formgenDynamicForm' => $formgenDynamicForm)) ?>