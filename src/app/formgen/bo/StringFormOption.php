<?php
namespace formgen\bo;

use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoTable;
use n2n\l10n\N2nLocale;
use n2n\web\dispatch\mag\Mag;
use n2n\impl\web\dispatch\mag\model\StringMag;
use rocket\impl\ei\component\prop\translation\Translator;
use n2n\persistence\orm\annotation\AnnoOneToMany;
use n2n\persistence\orm\CascadeType;

class StringFormOption extends FormOption {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoTable('formgen_string_form_option'));
		$ai->p('stringFormOptionTs', new AnnoOneToMany(StringFormOptionT::getClass(), 
				'stringFormOption', CascadeType::ALL, null, true));
	}
	
	private $maxLength;
	private $multiline;
	private $stringFormOptionTs;
	
	public function getMaxLength() {
		return $this->maxLength;
	}

	public function setMaxLength($maxLength) {
		$this->maxLength = $maxLength;
	}

	public function isMultiline() {
		return $this->multiline;
	}

	public function setMultiline($multiline) {
		$this->multiline = $multiline;
	}

	public function getStringFormOptionTs() {
		return $this->stringFormOptionTs;
	}

	public function setStringFormOptionTs($stringFormOptionTs) {
		$this->stringFormOptionTs = $stringFormOptionTs;
	}
	
	/**
	 * @param N2nLocale ...$n2nLocales
	 * @return StringFormOptionT
	 */
	public function ts(N2nLocale ... $n2nLocales) {
		return Translator::findAny($this->stringFormOptionTs, ... $n2nLocales);
	}
	
	/**
	 * {@inheritDoc}
	 * @see \formgen\bo\FormElement::buildMag()
	 * @return Mag|null
	 */
	public function buildMag(N2nLocale $n2nLocale): ?Mag {
		return $this->applyAttributes($n2nLocale, new StringMag($this->getLabel($n2nLocale), 
				$this->ts($n2nLocale)->getDefault(), $this->isMandatory(), $this->maxLength, $this->multiline));
	}
}