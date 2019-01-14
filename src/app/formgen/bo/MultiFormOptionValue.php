<?php
namespace formgen\bo;

use n2n\reflection\ObjectAdapter;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoTable;
use n2n\persistence\orm\annotation\AnnoOneToMany;
use n2n\persistence\orm\CascadeType;
use n2n\l10n\N2nLocale;
use rocket\impl\ei\component\prop\translation\Translator;
use n2n\persistence\orm\annotation\AnnoManyToOne;

class MultiFormOptionValue extends ObjectAdapter {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoTable('formgen_multi_form_option_value'));
		$ai->p('multiFormOptionValueTs', new AnnoOneToMany(MultiFormOptionValueT::getClass(), 'multiFormOptionValue', 
				CascadeType::ALL, null, true));
		$ai->p('multiFormOption', new AnnoManyToOne(MultiFormOption::getClass()));
	}
	
	private $id;
	private $multiFormOptionValueTs;
	private $multiFormOption;
	
	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getMultiFormOptionValueTs() {
		return $this->multiFormOptionValueTs;
	}

	public function setMultiFormOptionValueTs($multiFormOptionValueTs) {
		$this->multiFormOptionValueTs = $multiFormOptionValueTs;
	}
	
	public function getMultiFormOption() {
		return $this->multiFormOption;
	}

	public function setMultiFormOption($multiFormOption) {
		$this->multiFormOption = $multiFormOption;
	}

	/**
	 * @param N2nLocale ...$n2nLocales
	 * @return MultiFormOptionValueT
	 */
	public function t(N2nLocale ... $n2nLocales) {
		$n2nLocales[] = N2nLocale::getDefault();
		$n2nLocales[] = N2nLocale::getFallback();
		
		return Translator::findAny($this->multiFormOptionValueTs, ... $n2nLocales);
	}
}