<?php
namespace formgen\model;

use n2n\util\type\ArgUtils;
use formgen\bo\FormElement;
use n2n\web\dispatch\mag\MagCollection;
use n2n\l10n\N2nLocale;
use n2n\util\type\CastUtils;
use n2n\impl\web\dispatch\mag\model\MagForm;

class FormgenUtils {
	public static function createMagForm($formElements, N2nLocale $n2nLocale) {
		ArgUtils::valArrayLike($formElements, FormElement::class, false, 'formElements');
		$magCollection = new MagCollection();
		foreach ($formElements as $formElement) {
			CastUtils::assertTrue($formElement instanceof FormElement);
			$mag = $formElement->buildMag($n2nLocale);
			
			if (null === $mag) continue;
			$magCollection->addMag($formElement->getId(), $mag);
		}
		
		return new MagForm($magCollection);
	}
}