<?php
namespace formgen\bo;

use n2n\reflection\ObjectAdapter;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoTable;
use n2n\persistence\orm\annotation\AnnoManyToOne;
use rocket\impl\ei\component\prop\translation\Translatable;
use n2n\l10n\N2nLocale;

class DynamicFormT extends ObjectAdapter implements Translatable {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoTable('formgen_dynamic_form_t'));
		$ai->p('dynamicForm', new AnnoManyToOne(DynamicForm::getClass()));
	}
	
	private $id;
	private $n2nLocale;
	private $title;
	private $submitLabel;
	private $textThanksHtml;
	private $mailSubject;
	private $mailTextIntro;
	private $mailTextOutro;
	private $dynamicForm;
	
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

	public function getTitle() {
		return $this->title;
	}

	public function setTitle($title) {
		$this->title = $title;
	}

	public function getTextThanksHtml() {
		return $this->textThanksHtml;
	}

	public function setTextThanksHtml($textThanksHtml) {
		$this->textThanksHtml = $textThanksHtml;
	}
	
	public function getDynamicForm() {
		return $this->dynamicForm;
	}

	public function getMailSubject() {
		return $this->mailSubject;
	}

	public function setMailSubject($mailSubject) {
		$this->mailSubject = $mailSubject;
	}

	public function getMailTextIntro() {
		return $this->mailTextIntro;
	}

	public function setMailTextIntro($mailTextIntro) {
		$this->mailTextIntro = $mailTextIntro;
	}
	
	public function getSubmitLabel() {
		return $this->submitLabel;
	}

	public function getMailTextOutro() {
		return $this->mailTextOutro;
	}

	public function setMailTextOutro($mailTextOutro) {
		$this->mailTextOutro = $mailTextOutro;
	}

	public function setSubmitLabel($submitLabel) {
		$this->submitLabel = $submitLabel;
	}

	public function setDynamicForm(DynamicForm $dynamicForm) {
		$this->dynamicForm = $dynamicForm;
	}
	
	public function determineMailSubject() {
		return $this->mailSubject ?? $this->title;
	}
}