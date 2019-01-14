<?php
namespace formgen\bo;

use n2n\reflection\ObjectAdapter;
use n2n\persistence\orm\annotation\AnnoTable;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoOneToMany;
use n2n\persistence\orm\CascadeType;
use n2n\persistence\orm\FetchType;
use n2n\util\StringUtils;
use n2n\web\dispatch\mag\MagCollection;
use n2n\reflection\CastUtils;
use n2n\l10n\N2nLocale;
use n2n\impl\web\dispatch\mag\model\MagForm;
use n2n\persistence\orm\annotation\AnnoOrderBy;
use rocket\impl\ei\component\prop\translation\Translator;

class DynamicForm extends ObjectAdapter {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoTable('formgen_dynamic_form'));
		$ai->p('formElements', new AnnoOneToMany(FormElement::getClass(), 
						'dynamicForm', CascadeType::ALL, FetchType::EAGER, true), 
				new AnnoOrderBy(array('orderIndex' => 'ASC')));
		$ai->p('dynamicFormTs', new AnnoOneToMany(DynamicFormT::getClass(), 
				'dynamicForm', CascadeType::ALL, null, true));
	}
	
	private $id;
	private $emailAddressesJson = '[]';
	private $formElements;
	private $dynamicFormTs;
	
	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getEmailAddresses() {
		return StringUtils::jsonDecode($this->emailAddressesJson, true);
	}

	public function setEmailAddresses(array $emailAddresses) {
		$this->emailAddressesJson = StringUtils::jsonEncode($emailAddresses);
	}

	/**
	 * @return FormElement []
	 */
	public function getFormElements() {
		return $this->formElements;
	}

	public function setFormElements($formElements) {
		$this->formElements = $formElements;
	}
	
	public function getDynamicFormTs() {
		return $this->dynamicFormTs;
	}

	public function setDynamicFormTs($dynamicFormTs) {
		$this->dynamicFormTs = $dynamicFormTs;
	}
	
	public function determineSubmitLabel(N2nLocale $n2nLocale, string $alternativeLabel = null) {
		$translation = Translator::find($this->dynamicFormTs, $n2nLocale);
		if (null !== $translation && (null !== ($submitLabel = $translation->getSubmitLabel()))) return $submitLabel;
		
		return $alternativeLabel;
	}
	
	/**
	 * @param N2nLocale ...$n2nLocales
	 * @return DynamicFormT
	 */
	public function t(N2nLocale ... $n2nLocales) {
		$n2nLocales[] = N2nLocale::getDefault();
		$n2nLocales[] = N2nLocale::getFallback();
		
		return Translator::findAny($this->dynamicFormTs, ... $n2nLocales);
	}

	public function createMagForm(N2nLocale $n2nLocale) {
		$magCollection = new MagCollection();
		foreach ($this->formElements as $formElement) {
			CastUtils::assertTrue($formElement instanceof FormElement);
			$mag = $formElement->buildMag($n2nLocale);
			
			if (null === $mag) continue;
			$magCollection->addMag($formElement->getId(), $mag);
		}
		
		return new MagForm($magCollection);
	}
	
	public function determineLocaleDependentEmailAdresses(MagForm $magForm) {
		$emailAddresses = []; 
		foreach ($this->formElements as $formElement) {
			CastUtils::assertTrue($formElement instanceof FormElement);
			if (!$magForm->containsPropertyName($formElement->getId())) continue;
			
			foreach ($formElement->getEmails($magForm->getPropertyValue($formElement->getId())) as $email) {
				$emailAddresses[$email] = $email;
			}
		}
		
		return $emailAddresses;
	}
	
	public function determineSuggestedMailLabelWidth(N2nLocale $n2nLocale) {
		$suggestedMailLabelWidth = 0;
		foreach ($this->formElements as $formElement) {
			CastUtils::assertTrue($formElement instanceof FormElement);
			$elementLabelWidth = $formElement->getMailLabelWidth($n2nLocale);
			if ($suggestedMailLabelWidth < $elementLabelWidth) {
				$suggestedMailLabelWidth = $elementLabelWidth;
			}
		}
		
		//one for the : and one for the space afterwards
		return $suggestedMailLabelWidth + 2;
	}
}