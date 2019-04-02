<?php
namespace formgen\bo;

use n2n\web\http\orm\ResponseCacheClearer;
use n2n\l10n\N2nLocale;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\persistence\orm\annotation\AnnoTable;
use rocket\impl\ei\component\prop\translation\Translatable;
use n2n\reflection\ObjectAdapter;
use n2n\persistence\orm\annotation\AnnoManyToOne;

class MultiFormOptionT extends ObjectAdapter implements Translatable {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoEntityListeners(ResponseCacheClearer::getClass()), new AnnoTable('formgen_multi_form_option_t'));
		$ai->p('multiFormOption', new AnnoManyToOne(MultiFormOption::getClass()));
	}

	private $id;
	private $n2nLocale;
	private $emptyValue;
	private $multiFormOption;

	public function getId() {
		return $this->id;
	}

	public function setId(int $id) {
		$this->id = $id;
	}

	public function getN2nLocale() {
		return $this->n2nLocale;
	}

	public function setN2nLocale(N2nLocale $n2nLocale) {
		$this->n2nLocale = $n2nLocale;
	}

	public function getMultiFormOption() {
		return $this->multiFormOption;
	}

	public function setMultiFormOption(MultiFormOption $multiFormOption) {
		$this->multiFormOption = $multiFormOption;
	}

	public function getEmptyValue() {
		return $this->emptyValue;
	}

	public function setEmptyValue(string $emptyValue = null) {
		$this->emptyValue = $emptyValue;
	}
}