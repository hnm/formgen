<?php
namespace formgen\bo;

use n2n\l10n\N2nLocale;
use n2n\web\dispatch\mag\Mag;
use n2n\impl\web\dispatch\mag\model\BoolMag;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoTable;
use n2n\l10n\DynamicTextCollection;

class BoolFormOption extends FormOption {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoTable('formgen_bool_form_option'));
	}
	private $default;
	
	public function getDefault() {
		return $this->default;
	}

	public function setDefault($default) {
		$this->default = $default;
	}
	
	public function buildMag(N2nLocale $n2nLocale): ?Mag {
		$mag = (new BoolMag($this->getLabel($n2nLocale), $this->default))->setMandatory($this->isMandatory());
		return $this->applyAttributes($n2nLocale, $mag);
	}
	
	public function buildTextRepresentation(N2nLocale $n2nLocale, string $newLine,
			string $suggestedLabelWidth, $submittedValue): ?string {
		$dtc = new DynamicTextCollection('formgen', $n2nLocale);
				
		return str_pad($this->t($n2nLocale)->getLabel() . ':', $suggestedLabelWidth) . $dtc->t(($submittedValue) ? 'yes_txt' : 'no_txt');
	}
}