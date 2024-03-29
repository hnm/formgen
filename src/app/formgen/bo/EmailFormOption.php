<?php
namespace formgen\bo;

use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoTable;
use n2n\web\dispatch\mag\Mag;
use n2n\l10n\N2nLocale;
use n2n\impl\web\dispatch\mag\model\EmailMag;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\web\http\orm\ResponseCacheClearer;

class EmailFormOption extends FormOption {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoEntityListeners(ResponseCacheClearer::getClass()), new AnnoTable('formgen_email_form_option'));
	}
	private $sendCopy;
	
	public function getSendCopy() {
		return $this->sendCopy;
	}

	public function setSendCopy($sendCopy) {
		$this->sendCopy = $sendCopy;
	}
	
	/**
	 * {@inheritDoc}
	 * @see \formgen\bo\FormElement::buildMag()
	 * @return Mag|null
	 */
	public function buildMag(N2nLocale $n2nLocale): ?Mag {
		return $this->applyAttributes($n2nLocale, new EmailMag($this->getLabel($n2nLocale), null, $this->isMandatory()));
	}
	
	public function getEmails($submittedValue): array {
		if ($this->sendCopy) return [$submittedValue];
		
		return [];
	}
}