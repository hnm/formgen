<?php
namespace formgen\bo;

use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoTable;
use n2n\persistence\orm\annotation\AnnoOneToMany;
use n2n\persistence\orm\CascadeType;
use n2n\l10n\N2nLocale;
use rocket\impl\ei\component\prop\translation\Translator;
use n2nutil\bootstrap\ui\BsFormHtmlBuilder;
use n2n\impl\web\ui\view\html\HtmlView;
use formgen\model\FormgenConfig;
use n2n\web\ui\UiComponent;

class StaticFormOption extends FormElement {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoTable('formgen_static_form_option'));
		$ai->p('staticFormOptionTs', new AnnoOneToMany(StaticFormOptionT::getClass(), 
				'staticFormOption', CascadeType::ALL, null, true));
	}
	
	private $staticFormOptionTs;
	
	public function getStaticFormOptionTs() {
		return $this->staticFormOptionTs;
	}

	public function setStaticFormOptionTs($staticFormOptionTs) {
		$this->staticFormOptionTs = $staticFormOptionTs;
	}
	
	/**
	 * @param N2nLocale ...$n2nLocales
	 * @return StaticFormOptionT
	 */
	public function t(N2nLocale ... $n2nLocales) {
		$n2nLocales[] = N2nLocale::getDefault();
		$n2nLocales[] = N2nLocale::getFallback();
		
		return Translator::findAny($this->staticFormOptionTs, ... $n2nLocales);
	}
	
	/**
	 * {@inheritDoc}
	 * @see \formgen\bo\FormElement::createUiComponent()
	 * @return UiComponent|null
	 */
	public function createUiComponent(HtmlView $view): ?UiComponent {
		$formgenConfig = $view->lookup(FormgenConfig::class);
		$view->assert($formgenConfig instanceof FormgenConfig);
		
		$bsFormHtml = new BsFormHtmlBuilder($view, $formgenConfig->getBsComposer());
		
		$t = $this->t($view->getN2nLocale());
		$value = $t->getValue();
		$label = $t->getLabel();
		if (null !== $label && null === $value) return null;
		
		return $bsFormHtml->staticGroup(null, $t->getValue(), null, $t->getLabel());
	}
}