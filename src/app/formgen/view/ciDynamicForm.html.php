<?php
	use n2n\impl\web\ui\view\html\HtmlView;
	use formgen\bo\DynamicForm;
	use formgen\model\FormgenDynamicForm;
	use formgen\model\FormgenConfig;
		
	/**
	 * @var \n2n\impl\web\ui\view\html\HtmlView $view
	 */
	$view = HtmlView::view($view);
	$html = HtmlView::html($view);
	
	$dynamicForm = $view->getParam('dynamicForm');
	$view->assert($dynamicForm instanceof DynamicForm);
	
	$formgenConfig = $view->lookup(FormgenConfig::class);
	$view->assert($formgenConfig instanceof FormgenConfig);
	
	$html->meta()->addJs('formgen.js');
?>
<div class="formgen-ci-dynamic-form" 
		data-reload-url="<?php $html->out($view->buildUrlStr($formgenConfig->buildGetDynmicFormPartUrl($dynamicForm))) ?>">
	<?php $view->import('inc\dynamicFormPart.html', 
			array('formgenDynamicForm' => new FormgenDynamicForm($view->getN2nLocale(), $dynamicForm))) ?>
</div>