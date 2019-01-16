<?php
namespace formgen\bo;

use n2n\l10n\N2nLocale;
use n2n\web\dispatch\mag\Mag;
use n2n\l10n\DateTimeFormat;
use n2n\util\type\CastUtils;
use n2n\l10n\L10nUtils;
use n2nutil\jquery\datepicker\mag\DateTimePickerMag;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoTable;

class DateFormOption extends FormOption {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoTable('formgen_date_form_option'));
	}
	
	const DEFAULT_TYPE_TODAY = 'today';
	const DEFAULT_TYPE_TOMORROW = 'tomorrow';
	const DEFAULT_TYPE_SPECIFIC = 'specific';
	
	private $defaultType;
	private $defaultDate;
	
	public function getDefaultType() {
		return $this->defaultType;
	}

	public function setDefaultType($defaultType) {
		$this->defaultType = $defaultType;
	}

	public function getDefaultDate() {
		return $this->defaultDate;
	}

	public function setDefaultDate(\DateTime $defaultDate = null) {
		$this->defaultDate = $defaultDate;
	}

	public function buildMag(N2nLocale $n2nLocale): ?Mag {
		$defaultDate = null;
		switch ($this->defaultType) {
			case self::DEFAULT_TYPE_TODAY:
				$defaultDate = new \DateTime();
				break;
			case self::DEFAULT_TYPE_TOMORROW:
				$defaultDate = (new \DateTime())->add(new \DateInterval('P1D'));
				break;
			case self::DEFAULT_TYPE_SPECIFIC:
				$defaultDate = $this->defaultDate;
				break;
		}
		
		return $this->applyAttributes($n2nLocale, new DateTimePickerMag($this->getLabel($n2nLocale), null,
				null, DateTimeFormat::STYLE_NONE, null, $defaultDate, $this->isMandatory()));
	}
	
	public function buildTextRepresentation(N2nLocale $n2nLocale, string $newLine,
			string $suggestedLabelWidth, $submittedValue): ?string {
		if (null !== $submittedValue) {
			CastUtils::assertTrue($submittedValue instanceof \DateTime);
			$submittedValue = L10nUtils::formatDateTime($submittedValue, $n2nLocale, null, DateTimeFormat::STYLE_NONE);
		}
		
		return parent::buildTextRepresentation($n2nLocale, $newLine, $suggestedLabelWidth, $submittedValue);
	}
}