<?php
namespace formgen\bo;

use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoTable;
use n2n\web\dispatch\mag\Mag;
use n2n\l10n\N2nLocale;
use rocket\impl\ei\component\prop\translation\Translator;
use n2n\persistence\orm\annotation\AnnoOneToMany;
use n2n\persistence\orm\CascadeType;
use n2n\impl\web\ui\view\html\HtmlView;
use n2n\web\ui\UiComponent;

abstract class FormOption extends FormElement {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoTable('formgen_form_option'));
		$ai->p('formOptionTs', new AnnoOneToMany(FormOptionT::getClass(), 'formOption', 
				CascadeType::ALL, null, true));
	}
	
	private $mandatory;
	private $formOptionTs;

	public function isMandatory() {
		return $this->mandatory;
	}

	public function setMandatory($mandatory) {
		$this->mandatory = $mandatory;
	}
	
	public function getFormOptionTs() {
		return $this->formOptionTs;
	}

	public function setFormOptionTs($formOptionTs) {
		$this->formOptionTs = $formOptionTs;
	}

	/**
	 * @param N2nLocale ...$n2nLocales
	 * @return FormOptionT
	 */
	public function t(N2nLocale ... $n2nLocales) {
		$n2nLocales[] = N2nLocale::getDefault();
		$n2nLocales[] = N2nLocale::getFallback();
		
		return Translator::findAny($this->formOptionTs, ... $n2nLocales);
	}
	
	public function getLabel(N2nLocale $n2nLocale) {
		return $this->t($n2nLocale)->getLabel();
	}
	
	public function getHelpText(N2nLocale $n2nLocale) {
		return $this->t($n2nLocale)->getHelpText();
	}
	
	public function applyAttributes(N2nLocale $n2nLocale, Mag $mag) {
		return $mag;
	}
	
	public function createUiComponent(HtmlView $view): ?UiComponent {
		return null;
	}
	
	public function getMailLabelWidth(N2nLocale $n2nLocale): int {
		return mb_strlen($this->getLabel($n2nLocale));
	}
	
	public function buildTextRepresentation(N2nLocale $n2nLocale, string $newLine,
			string $suggestedLabelWidth, $submittedValue): ?string {
		$label = $this->t($n2nLocale)->getLabel() . ':';
		return $label . str_repeat(' ', $suggestedLabelWidth - mb_strlen($label)) . $submittedValue;
	}
}
