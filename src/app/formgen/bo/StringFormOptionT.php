<?php
namespace formgen\bo;

use n2n\reflection\ObjectAdapter;
use n2n\persistence\orm\annotation\AnnoTable;
use n2n\reflection\annotation\AnnoInit;
use n2n\l10n\N2nLocale;
use n2n\persistence\orm\annotation\AnnoManyToOne;
use rocket\impl\ei\component\prop\translation\Translatable;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\web\http\orm\ResponseCacheClearer;

class StringFormOptionT extends ObjectAdapter implements Translatable {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoEntityListeners(ResponseCacheClearer::getClass()), new AnnoTable('formgen_string_form_option_t'));
		$ai->p('stringFormOption', new AnnoManyToOne(StringFormOption::getClass()));
	}
	
	private $id;
	private $n2nLocale;
	private $default;
	private $stringFormOption;
	
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

	public function getDefault() {
		return $this->default;
	}

	public function setDefault($default) {
		$this->default = $default;
	}

	public function getStringFormOption() {
		return $this->stringFormOption;
	}

	public function setStringFormOption($stringFormOption) {
		$this->stringFormOption = $stringFormOption;
	}
	
}