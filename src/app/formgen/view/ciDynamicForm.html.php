<?php
	use n2n\impl\web\ui\view\html\HtmlView;
	use formgen\bo\DynamicForm;
use formgen\model\FormgenDynamicForm;
	
	$view = HtmlView::view($view);
	$html = HtmlView::html($view);
	
	$dynamicForm = $view->getParam('dynamicForm');
	$view->assert($dynamicForm instanceof DynamicForm);
?>
<div class="formgen-ci-dynamic-form">
	<?php $view->import('inc\dynamicFormPart.html', 
			array('formgenDynamicForm' => new FormgenDynamicForm($view->getN2nLocale(), $dynamicForm))) ?>
</div>