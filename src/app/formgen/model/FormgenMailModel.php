<?php
namespace formgen\model;

use n2n\context\RequestScoped;
use n2n\web\http\Request;
use n2n\l10n\N2nLocale;
use n2n\mail\MailUtils;
use n2n\l10n\DynamicTextCollection;

class FormgenMailModel implements RequestScoped {
	const NEW_LINE = "\n";
	private $request;
	
	private function _init(Request $request) {
		$this->request = $request;
	}
	
	public function sendEmails(FormgenDynamicForm $formgenDynamicForm) {
		$dynamicForm = $formgenDynamicForm->getDynamicForm();
		$this->sendToEmailAddresses($formgenDynamicForm, N2nLocale::getAdmin(), 
				$dynamicForm->getEmailAddresses(), true);
		
		$this->sendToEmailAddresses($formgenDynamicForm, $this->request->getN2nLocale(), 
				$dynamicForm->determineLocaleDependentEmailAdresses($formgenDynamicForm->dynamicMagForm));
	}
	
	private function sendToEmailAddresses(FormgenDynamicForm $formgenDynamicForm, 
			N2nLocale $n2nLocale, array $emailAddresses, bool $appendInfo = false) {
		if (empty($emailAddresses)) return;
		
		$subject = $formgenDynamicForm->getDynamicForm()->t($n2nLocale)->determineMailSubject();
		$message = $this->buildMessage($formgenDynamicForm, $n2nLocale);
		
		if ($appendInfo) {
			$dtc = new DynamicTextCollection('formgen', $n2nLocale);
			$message .= self::NEW_LINE
				. $dtc->t('ip_address_txt') . ': ' . $_SERVER['REMOTE_ADDR'] 
				. ' ' . $dtc->t('date_txt') . ': ' . date('d.m.Y h:i:s');
		}
		
		MailUtils::sendNotificationMail($subject, $message, $emailAddresses);
	}
		
	private function buildMessage(FormgenDynamicForm $formgenDynamicForm, N2nLocale $n2nLocale) {
		$dynamicForm = $formgenDynamicForm->getDynamicForm();
		$dynamicFormT = $dynamicForm->t($n2nLocale);
		
		$suggestedLabelWidth = $dynamicForm->determineSuggestedMailLabelWidth($n2nLocale);
		
		$message = '';
		
		if (!empty($intro = $dynamicFormT->getMailTextIntro())) {
			 $message .= $intro . self::NEW_LINE . self::NEW_LINE;
		}
		
		foreach ($dynamicForm->getFormElements() as $formElement) {
			$submittedValue = null;
			if ($formgenDynamicForm->dynamicMagForm->containsPropertyName($formElement->getId())) {
				$submittedValue = $formgenDynamicForm->dynamicMagForm->getPropertyValue($formElement->getId());
			}
			
			$textRepresentation = $formElement->buildTextRepresentation($n2nLocale, self::NEW_LINE, 
					$suggestedLabelWidth, $submittedValue);
			if (empty($textRepresentation)) continue;
			
			$message .= $textRepresentation . self::NEW_LINE;
		}
		
		if (!empty($mailTextOutro = $dynamicFormT->getMailTextOutro())) {
			$message .=  self::NEW_LINE . $mailTextOutro . self::NEW_LINE;
		}
		
		return $message;
	}
}