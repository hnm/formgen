<?php
namespace formgen\bo;

use n2n\impl\web\ui\view\html\HtmlView;
use n2n\web\ui\UiComponent;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoTable;
use n2n\l10n\N2nLocale;
use rocket\impl\ei\component\prop\translation\Translator;
use rocket\impl\ei\component\prop\string\cke\ui\CkeHtmlBuilder;
use n2n\persistence\orm\annotation\AnnoOneToMany;
use n2n\persistence\orm\CascadeType;

class FormText extends FormElement {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoTable('formgen_form_text'));
		$ai->p('formTextTs', new AnnoOneToMany(FormTextT::getClass(), 'formText', CascadeType::ALL, 
				null, true));
	}
	
	private $formTextTs;
	
	public function getFormTextTs() {
		return $this->formTextTs;
	}

	public function setFormTextTs($formTextTs) {
		$this->formTextTs = $formTextTs;
	}

	/**
	 * @param N2nLocale ...$n2nLocales
	 * @return FormTextT
	 */
	public function t(N2nLocale ... $n2nLocales) {
		return Translator::findAny($this->formTextTs, ... $n2nLocales);
	}
	
	/**
	 * {@inheritDoc}
	 * @see \formgen\bo\FormElement::createUiComponent()
	 * @return UiComponent|null
	 */
	public function createUiComponent(HtmlView $view): ?UiComponent {
		$ckeHtml = new CkeHtmlBuilder($view);
		
		return $ckeHtml->getOut($this->t($view->getN2nLocale())->getTextHtml());
	}
}