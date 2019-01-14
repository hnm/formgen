<?php
namespace formgen\model;

use formgen\bo\DynamicForm;
use n2n\l10n\N2nLocale;
use n2n\web\dispatch\Dispatchable;
use n2n\reflection\annotation\AnnoInit;
use n2n\web\dispatch\annotation\AnnoDispObject;
use n2n\web\dispatch\map\bind\BindingDefinition;

class FormgenDynamicForm implements Dispatchable {
	private static function _annos(AnnoInit $ai) {
		$ai->p('dynamicMagForm', new AnnoDispObject());
	}
	
	private $dynamicForm;
	public $dynamicMagForm;
	
	public function __construct(N2nLocale $n2nLocale, DynamicForm $dynamicForm) {
		$this->dynamicForm = $dynamicForm;
		$this->dynamicMagForm = $dynamicForm->createMagForm($n2nLocale);
	}
	
	public function getDynamicForm() {
		return $this->dynamicForm;
	}
	
	private function _validation(BindingDefinition $bd) {
		
	}
	
	public function send(FormgenMailModel $mailModel) {
		$mailModel->sendEmails($this);
	}
}