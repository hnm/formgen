<?php
namespace formgen\bo;

use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoTable;
use n2n\l10n\N2nLocale;
use rocket\impl\ei\component\prop\translation\Translator;
use n2n\impl\web\ui\view\html\HtmlView;
use n2n\impl\web\ui\view\html\HtmlElement;
use n2n\web\ui\UiComponent;
use n2n\persistence\orm\annotation\AnnoOneToMany;
use n2n\persistence\orm\CascadeType;
use formgen\model\FormgenConfig;

class FormTitle extends FormElement {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoTable('formgen_form_title'));
		$ai->p('formTitleTs', new AnnoOneToMany(FormTitleT::getClass(), 'formTitle', CascadeType::ALL, null, true));
	}
	
	private $formTitleTs;
	
	public function getFormTitleTs() {
		return $this->formTitleTs;
	}

	public function setFormTitleTs($formTitleTs) {
		$this->formTitleTs = $formTitleTs;
	}
	
	/**
	 * @param N2nLocale ...$n2nLocales
	 * @return FormTitleT
	 */
	public function t(N2nLocale ... $n2nLocales) {
		$n2nLocales[] = N2nLocale::getDefault();
		$n2nLocales[] = N2nLocale::getFallback();
		
		return Translator::requireAny($this->formTitleTs, ... $n2nLocales);
	}
	
	public function createUiComponent(HtmlView $view): ?UiComponent {
		$formgenConfig = $view->lookup(FormgenConfig::class);
		$view->assert($formgenConfig instanceof FormgenConfig);
		
		return new HtmlElement('h2', array('class' => 'formgen-form-title'), 
				$this->t($view->getN2nLocale())->getTitle());
	}
}