<?php
	use n2n\impl\web\ui\view\html\HtmlView;
	use formgen\bo\DynamicForm;
	use formgen\model\FormgenConfig;
	use rocket\impl\ei\component\prop\string\cke\ui\CkeHtmlBuilder;
	
	$view = HtmlView::view($view);
	$html = HtmlView::html($view);
	
	$dynamicForm = $view->getParam('dynamicForm');
	$view->assert($dynamicForm instanceof DynamicForm);
	
	$formgenConfig = $view->lookup(FormgenConfig::class);
	$view->assert($formgenConfig instanceof FormgenConfig);

	$dynamicFormT = $dynamicForm->t($view->getN2nLocale());
	
	$ckeHtml = new CkeHtmlBuilder($view);
	
	$view->useTemplate($formgenConfig->getTemplateViewId(),
			array('title' => $dynamicFormT->getTitle(), 'dynamicForm' => $dynamicForm));
?>
<div class="formgen-form-thanks">
	<?php $ckeHtml->out($dynamicFormT->getTextThanksHtml()) ?>
</div>