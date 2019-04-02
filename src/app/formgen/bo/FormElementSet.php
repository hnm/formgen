<?php
namespace formgen\bo;

use n2n\web\http\orm\ResponseCacheClearer;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\persistence\orm\annotation\AnnoTable;
use n2n\reflection\ObjectAdapter;
use n2n\persistence\orm\annotation\AnnoOneToMany;
use n2n\l10n\N2nLocale;
use formgen\model\FormgenUtils;

class FormElementSet extends ObjectAdapter {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoEntityListeners(ResponseCacheClearer::getClass()), new AnnoTable('formgen_form_element_set'));
		$ai->p('formElements', new AnnoOneToMany(FormElement::getClass(), null, \n2n\persistence\orm\CascadeType::ALL, null, true));
	}

	private $id;
	private $title;
	private $formElements;

	public function __construct() {
		return $this->formElements;
	}

	public function getId() {
		return $this->id;
	}

	public function setId(int $id) {
		$this->id = $id;
	}

	/**
	 * @return FormElement[]
	 */
	public function getFormElements() {
		return $this->formElements;
	}

	public function setFormElements($formElements) {
		$this->formElements = $formElements;
	}

	public function hasFormElements() {
		return count($this->formElements) > 0;
	}

	public function createMagForm(N2nLocale $n2nLocale) {
		return FormgenUtils::createMagForm($this->formElements, $n2nLocale);
	}

	public function getTitle() {
		return $this->title;
	}

	public function setTitle(string $title = null) {
		$this->title = $title;
	}
}