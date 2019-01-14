<?php
namespace formgen\bo;

use n2n\reflection\ObjectAdapter;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoTable;
use n2n\persistence\orm\annotation\AnnoInheritance;
use n2n\persistence\orm\InheritanceType;
use n2n\persistence\orm\annotation\AnnoManyToOne;
use n2n\impl\web\ui\view\html\HtmlView;
use n2n\web\ui\UiComponent;
use n2n\l10n\N2nLocale;
use n2n\web\dispatch\mag\Mag;
use formgen\bo\DynamicForm;

abstract class FormElement extends ObjectAdapter {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoTable('formgen_form_element'), new AnnoInheritance(InheritanceType::JOINED));
		$ai->p('dynamicForm', new AnnoManyToOne(DynamicForm::getClass()));
	}

	private $id;
	private $dynamicForm;
	private $orderIndex;

	public function buildMag(N2nLocale $n2nLocale): ?Mag {
		return null;
	}

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

	/**
	 * @return DynamicForm
	 */
	public function getDynamicForm() {
		return $this->dynamicForm;
	}

	public function setDynamicForm($dynamicForm) {
		$this->dynamicForm = $dynamicForm;
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