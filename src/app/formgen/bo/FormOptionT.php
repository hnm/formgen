<?php
namespace formgen\bo;

use n2n\reflection\ObjectAdapter;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoTable;
use rocket\impl\ei\component\prop\translation\Translatable;
use n2n\persistence\orm\annotation\AnnoManyToOne;
use n2n\l10n\N2nLocale;
use n2n\persistence\orm\FetchType;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\web\http\orm\ResponseCacheClearer;

class FormOptionT extends ObjectAdapter implements Translatable {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoEntityListeners(ResponseCacheClearer::getClass()), new AnnoTable('formgen_form_option_t'));
		$ai->p('formOption', new AnnoManyToOne(FormOption::getClass(), null, FetchType::EAGER));
	}
	
	private $id;
	private $n2nLocale;
	private $label;
	private $helpText;
	private $formOption;
	
	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getN2nLocale() {
		return $this->n2nLocale;
	}

	public function setN2nLocale(N2nLocale $n2nLocale) {
		$this->n2nLocale = $n2nLocale;
	}

	public function getLabel() {
		return $this->label;
	}

	public function setLabel($label) {
		$this->label = $label;
	}

	public function getHelpText() {
		return $this->helpText;
	}

	public function setHelpText($helpText) {
		$this->helpText = $helpText;
	}

	public function getFormOption() {
		return $this->formOption;
	}

	public function setFormOption($formOption) {
		$this->formOption = $formOption;
	}
}