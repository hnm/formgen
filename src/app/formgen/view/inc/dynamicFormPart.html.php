<?php
	use n2n\impl\web\ui\view\html\HtmlView;
	use n2nutil\bootstrap\ui\BsFormHtmlBuilder;
	use formgen\model\FormgenConfig;
	use formgen\model\FormgenDynamicForm;
	use n2n\web\dispatch\map\PropertyPath;
	
	$view = HtmlView::view($view);
	$html = HtmlView::html($view);
	$formHtml = HtmlView::formHtml($view);
	
	$formgenDynamicForm = $view->getParam('formgenDynamicForm');
	$view->assert($formgenDynamicForm instanceof FormgenDynamicForm);
	
	$dynamicForm = $formgenDynamicForm->getDynamicForm();
	
	$formgenConfig = $view->lookup(FormgenConfig::class);
	$view->assert($formgenConfig instanceof FormgenConfig);
	
	$bsFormHtml = new BsFormHtmlBuilder($view, $formgenConfig->getBsComposer());
?>
<?php $bsFormHtml->open($formgenDynamicForm, null, null, 
		array('class' => 'formgen-dynamic-form formgen-dynamic-form-' . $dynamicForm->getId()), 
		$formgenConfig->buildFormSubmitUrl($dynamicForm)) ?>
	<?php $view->import('formElements.html', ['formElements' => $dynamicForm->getFormElements(), 
			'propPath' => PropertyPath::createFromArray(['dynamicMagForm'])]) ?>
	<?php $bsFormHtml->buttonSubmitGroup('send', 
			$dynamicForm->determineSubmitLabel($view->getN2nLocale(), $view->getL10nText('common_submit_txt'))) ?>
<?php $bsFormHtml->close() ?>