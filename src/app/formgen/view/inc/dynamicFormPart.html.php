<?php
	use n2n\impl\web\ui\view\html\HtmlView;
	use n2nutil\bootstrap\ui\BsFormHtmlBuilder;
	use formgen\model\FormgenConfig;
	use formgen\model\FormgenDynamicForm;
	use n2n\web\dispatch\map\PropertyPath;
	use n2nutil\bootstrap\ui\Bs;
	
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
	<?php foreach ($dynamicForm->getFormElements() as $formElement): ?>
		<?php if (null !== ($uiComponent = $formElement->createUiComponent($view))): ?>
			<?php $view->out($uiComponent) ?>
		<?php endif ?>
		<?php if ($formgenDynamicForm->dynamicMagForm->containsPropertyName($formElement->getId())): ?>
			<?php $bsFormHtml->magGroup(new PropertyPath(array('dynamicMagForm', $formElement->getId())), 
					Bs::req($formElement->isMandatory())->hTxt($formElement->getHelpText($view->getN2nLocale()))) ?>
		<?php endif ?>
	<?php endforeach ?>
	<?php $bsFormHtml->buttonSubmitGroup('send', 
			$dynamicForm->determineSubmitLabel($view->getN2nLocale(), $view->getL10nText('common_submit_txt'))) ?>
<?php $bsFormHtml->close() ?>