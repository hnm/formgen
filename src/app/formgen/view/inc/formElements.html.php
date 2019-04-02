<?php
	use n2n\impl\web\ui\view\html\HtmlView;
	use n2n\web\dispatch\map\PropertyPath;
	use formgen\bo\FormElement;
	use formgen\model\FormgenConfig;
	use n2nutil\bootstrap\ui\BsFormHtmlBuilder;
	use n2nutil\bootstrap\ui\Bs;
	
	$view = HtmlView::view($view);
	$html = HtmlView::html($view);
	
	$formgenConfig = $view->lookup(FormgenConfig::class);
	$view->assert($formgenConfig instanceof FormgenConfig);
	
	$formElements = $view->getParam('formElements');
	$propPath = $view->getParam('propPath');
	$bsComposer = $view->getParam('bsComposer', false, $formgenConfig->getBsComposer());
	
	$bsFormHtml = new BsFormHtmlBuilder($view, $bsComposer);
	
	$view->assert($propPath instanceof PropertyPath);
?>
<?php foreach ($formElements as $formElement): ?>
	<?php $view->assert($formElement instanceof FormElement) ?>
	<?php if (null !== ($uiComponent = $formElement->createUiComponent($view))): ?>
		<?php $view->out($uiComponent) ?>
	<?php endif ?>
	<?php if (null !== $formElement->buildMag($view->getN2nLocale())): ?>
		<?php $bsFormHtml->magGroup($propPath->ext($formElement->getId()), 
				Bs::req($formElement->isMandatory())->hTxt($formElement->getHelpText($view->getN2nLocale()))) ?>
	<?php endif ?>
<?php endforeach ?>