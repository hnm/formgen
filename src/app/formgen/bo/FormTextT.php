<?php
namespace formgen\bo;

use n2n\reflection\ObjectAdapter;
use rocket\impl\ei\component\prop\translation\Translatable;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoTable;
use n2n\persistence\orm\annotation\AnnoManyToOne;
use n2n\l10n\N2nLocale;

class FormTextT extends ObjectAdapter implements Translatable {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoTable('formgen_form_txt_t'));
		$ai->p('formText', new AnnoManyToOne(FormText::getClass()));
	}
	
	private $id;
	private $n2nLocale;
	private $textHtml;
	private $formText;
	
	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getN2nLocale() {
		return $this->n2nLocale;
	}

	public function setN2nLocale(N2nLocale $n2nLocale) {
		$this->n2nLocale = $n2nLocale;
	}

	public function getTextHtml() {
		return $this->textHtml;
	}

	public function setTextHtml($textHtml) {
		$this->textHtml = $textHtml;
	}

	public function getFormText() {
		return $this->formText;
	}

	public function setFormText($formText) {
		$this->formText = $formText;
	}
}