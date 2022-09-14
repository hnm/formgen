<?php
namespace formgen\bo;

use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoTable;
use n2n\l10n\N2nLocale;
use n2n\impl\web\dispatch\mag\model\NumericMag;
use n2n\web\dispatch\mag\Mag;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\web\http\orm\ResponseCacheClearer;

class NumericFormOption extends FormOption {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoEntityListeners(ResponseCacheClearer::getClass()), new AnnoTable('formgen_numeric_form_option'));
	}
	
	private $default;
	private $min;
	private $max;
	
	public function getDefault() {
		return $this->default;
	}

	public function setDefault($default) {
		$this->default = $default;
	}

	public function getMin() {
		return $this->min;
	}

	public function setMin($min) {
		$this->min = $min;
	}

	public function getMax() {
		return $this->max;
	}

	public function setMax($max) {
		$this->max = $max;
	}
	
	/**
	 * {@inheritDoc}
	 * @see \formgen\bo\FormElement::buildMag()
	 * @return Mag|null
	 */
	public function buildMag(N2nLocale $n2nLocale): ?Mag {
		return $this->applyAttributes($n2nLocale, new NumericMag($this->getLabel($n2nLocale), 
				$this->default, $this->isMandatory(), $this->min, $this->max));
	}
}