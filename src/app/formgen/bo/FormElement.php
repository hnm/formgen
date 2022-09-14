<?php
namespace formgen\bo;

use n2n\reflection\ObjectAdapter;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoTable;
use n2n\persistence\orm\annotation\AnnoInheritance;
use n2n\persistence\orm\InheritanceType;
use n2n\impl\web\ui\view\html\HtmlView;
use n2n\web\ui\UiComponent;
use n2n\l10n\N2nLocale;
use n2n\web\dispatch\mag\Mag;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\web\http\orm\ResponseCacheClearer;

abstract class FormElement extends ObjectAdapter {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoEntityListeners(ResponseCacheClearer::getClass()), new AnnoTable('formgen_form_element'), new AnnoInheritance(InheritanceType::JOINED));
	}

	private $id;
	private $orderIndex;
	
	/**
	 * {@inheritDoc}
	 * @see \formgen\bo\FormElement::buildMag()
	 * @return Mag|null
	 */
	public function buildMag(N2nLocale $n2nLocale): ?Mag {
		return null;
	}

	/**
	 * @param HtmlView $view
	 * @return UiComponent|NULL
	 */
	public abstract function createUiComponent(HtmlView $view): ?UiComponent;
	
	public function buildTextRepresentation(N2nLocale $n2nLocale, string $newLine, 
			string $suggestedLabelWidth, $submittedValue): ?string {
		return null;
	}
	
	public function getMailLabelWidth(N2nLocale $n2nLocale): int {
		return 0;
	}

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getOrderIndex() {
		return $this->orderIndex;
	}

	public function setOrderIndex($orderIndex) {
		$this->orderIndex = $orderIndex;
	}
	
	public function getEmails($submittedValue): array {
		return array();
	}
	
	public function isMandatory() {
		return false;
	}
	
	public function getHelpText(N2nLocale $n2nLocale) {
		return null;
	}
}