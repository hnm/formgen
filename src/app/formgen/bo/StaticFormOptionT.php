<?php
namespace formgen\bo;

use n2n\reflection\ObjectAdapter;
use rocket\impl\ei\component\prop\translation\Translatable;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoTable;
use n2n\l10n\N2nLocale;
use n2n\persistence\orm\annotation\AnnoManyToOne;

class StaticFormOptionT extends ObjectAdapter implements Translatable {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoTable('formgen_static_form_option_t'));
		$ai->p('staticFormOption', new AnnoManyToOne(StaticFormOption::getClass()));
	}
	
	private $id;
	private $n2nLocale;
	private $value;
	private $label;
	private $staticFormOption;
	
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

	public function getValue() {
		return $this->value;
	}

	public function setValue($value) {
		$this->value = $value;
	}

	public function getStaticFormOption() {
		return $this->staticFormOption;
	}

	public function setStaticFormOption($staticFormOption) {
		$this->staticFormOption = $staticFormOption;
	}
}