<?php
namespace formgen\bo;

use n2n\reflection\ObjectAdapter;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoTable;
use n2n\persistence\orm\annotation\AnnoOneToMany;
use n2n\l10n\N2nLocale;
use rocket\impl\ei\component\prop\translation\Translator;
use n2n\persistence\orm\annotation\AnnoManyToOne;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\web\http\orm\ResponseCacheClearer;

class MultiFormOptionValue extends ObjectAdapter {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoEntityListeners(ResponseCacheClearer::getClass()), new AnnoTable('formgen_multi_form_option_value'));
		$ai->p('multiFormOptionValueTs', new AnnoOneToMany(MultiFormOptionValueT::getClass(), 'multiFormOptionValue', \n2n\persistence\orm\CascadeType::ALL, null, true));
		$ai->p('multiFormOption', new AnnoManyToOne(MultiFormOption::getClass()));
	}

	private $id;
	private $multiFormOptionValueTs;
	private $multiFormOption;
	private $selected;

	public function getId() {
		return $this->id;
	}

	public function setId(int $id = null) {
		$this->id = $id;
	}

	/**
	 * @return MultiFormOptionValueT[]
	 */
	public function getMultiFormOptionValueTs() {
		return $this->multiFormOptionValueTs;
	}

	public function setMultiFormOptionValueTs($multiFormOptionValueTs) {
		$this->multiFormOptionValueTs = $multiFormOptionValueTs;
	}

	public function getMultiFormOption() {
		return $this->multiFormOption;
	}

	public function setMultiFormOption(MultiFormOption $multiFormOption = null) {
		$this->multiFormOption = $multiFormOption;
	}

	/**
	 * @param N2nLocale ...$n2nLocales
	 * @return MultiFormOptionValueT
	 */
	public function t(N2nLocale ...$n2nLocales) {
		return Translator::findAny($this->multiFormOptionValueTs, ... $n2nLocales);
	}

	public function isSelected() {
		return $this->selected;
	}

	public function setSelected(bool $selected = false) {
		$this->selected = $selected;
	}
}