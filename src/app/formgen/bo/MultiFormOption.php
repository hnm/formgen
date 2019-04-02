<?php
namespace formgen\bo;

use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoTable;
use n2n\persistence\orm\annotation\AnnoOneToMany;
use n2n\l10n\N2nLocale;
use n2n\web\dispatch\mag\Mag;
use n2n\impl\web\dispatch\mag\model\EnumMag;
use n2n\impl\web\dispatch\mag\model\MultiSelectMag;
use n2n\util\type\CastUtils;
use n2n\util\type\ArgUtils;
use rocket\impl\ei\component\prop\translation\Translator;
use n2n\util\col\ArrayUtils;

class MultiFormOption extends FormOption {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoTable('formgen_multi_form_option'));
		$ai->p('multiFormOptionValues', new AnnoOneToMany(
				MultiFormOptionValue::getClass(), 'multiFormOption', \n2n\persistence\orm\CascadeType::ALL, null, true));
		$ai->p('multiFormOptionTs', new AnnoOneToMany(MultiFormOptionT::getClass(), 'multiFormOption', \n2n\persistence\orm\CascadeType::ALL, null, true));
	}
	
	const TYPE_RADIO = 'radio';
	const TYPE_SELECT = 'select';
	const TYPE_CHECKBOX = 'checkbox';
	
	private $type;
	private $multiFormOptionValues;
	private $multiFormOptionTs;
	
	public function __construct() {
		$this->multiFormOptionValues = new \ArrayObject();
	}
	
	public function getType() {
		return $this->type;
	}
	
	public function setType(string $type = null) {
		$this->type = $type;
	}
	
	/**
	 *
	 * @return MultiFormOptionValue[]
	 */
	public function getMultiFormOptionValues() {
		return $this->multiFormOptionValues;
	}
	
	public function setMultiFormOptionValues($multiFormOptionValues) {
		$this->multiFormOptionValues = $multiFormOptionValues;
	}
	
	/**
	 * {@inheritDoc}
	 * @see \formgen\bo\FormElement::buildMag()
	 * @return Mag|null
	 */
	public function buildMag(N2nLocale $n2nLocale): ?Mag {
		$mag = null;
		$options = $this->buildOptions($n2nLocale);
		switch ($this->type) {
			case self::TYPE_RADIO :
			case self::TYPE_SELECT :
				$mag = (new EnumMag($this->getLabel($n2nLocale), $options, $this->buildDefaultValue(), $this->isMandatory()))->setUseRadios($this->type === self::TYPE_RADIO);
				break;
			
			case self::TYPE_CHECKBOX :
				$mag = new MultiSelectMag($this->getLabel($n2nLocale), $options, $this->buildDefaultValue(), $this->isMandatory () ? 1 : 0 );
				break;
		}
		
		return $this->applyAttributes ( $n2nLocale, $mag );
	}
	
	public function buildOptions(N2nLocale $n2nLocale) {
		$options = array();
		if (!$this->isMandatory() && $this->getType() !== self::TYPE_CHECKBOX) {
			$options[null] = $this->ts($n2nLocale)->getEmptyValue();
		}
		
		foreach ( $this->multiFormOptionValues as $multiFormOptionValue ) {
			CastUtils::assertTrue ( $multiFormOptionValue instanceof MultiFormOptionValue );
			$options [$multiFormOptionValue->getId ()] = $multiFormOptionValue->t ( $n2nLocale )->getLabel ();
		}
		
		return $options;
	}
	
	public function buildDefaultValue() {
		$selectedValues = [];
		foreach ($this->getMultiFormOptionValues() as $mfov) {
			if (!$mfov->isSelected()) continue;
			
			$selectedValues[$mfov->getId()] = $mfov->getId();
		}
		
		if ($this->type === self::TYPE_CHECKBOX) {
			return $selectedValues;
		}
		
		return ArrayUtils::first($selectedValues);
	}
	
	public function buildTextRepresentation(N2nLocale $n2nLocale, string $newLine, string $suggestedLabelWidth, $submittedValue): ?string {
		$value = '';
		if ($this->type === self::TYPE_CHECKBOX) {
			ArgUtils::valArray($submittedValue, 'scalar' );
			$valueParts = [];
			
			foreach ( $submittedValue as $valueId ) {
				$valueParts [] = $this->getLabelForValueId ( $n2nLocale, $valueId );
			}
			
			$value = implode(', ', $valueParts );
		} else {
			ArgUtils::valScalar ( $submittedValue, true, 'submittedValue' );
			$value = $this->getLabelForValueId ( $n2nLocale, $submittedValue );
		}
		
		return parent::buildTextRepresentation ( $n2nLocale, $newLine, $suggestedLabelWidth, $value );
	}
	
	private function getLabelForValueId(N2nLocale $n2nLocale, $id) {
		foreach ( $this->multiFormOptionValues as $multiFormOptionValue ) {
			CastUtils::assertTrue($multiFormOptionValue instanceof MultiFormOptionValue);
			if ($multiFormOptionValue->getId () == $id) {
				return $multiFormOptionValue->t($n2nLocale)->getLabel();
			}
		}
		
		return '';
	}
	
	/**
	 *
	 * @return MultiFormOptionT[]
	 */
	public function getMultiFormOptionTs() {
		return $this->multiFormOptionTs;
	}
	
	public function setMultiFormOptionTs($multiFormOptionTs) {
		$this->multiFormOptionTs = $multiFormOptionTs;
	}
	
	/**
	 * @param N2nLocale ...$n2nLocales
	 * @return MultiFormOptionT
	 */
	public function ts(N2nLocale ... $n2nLocales) {
		return Translator::findAny($this->multiFormOptionTs, ... $n2nLocales);
	}
}