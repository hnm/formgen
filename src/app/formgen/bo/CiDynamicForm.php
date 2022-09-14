<?php
namespace formgen\bo;

use rocket\impl\ei\component\prop\ci\model\ContentItem;
use n2n\impl\web\ui\view\html\HtmlView;
use n2n\persistence\orm\annotation\AnnoTable;
use n2n\reflection\annotation\AnnoInit;
use formgen\bo\DynamicForm;
use n2n\persistence\orm\annotation\AnnoManyToOne;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\web\http\orm\ResponseCacheClearer;

class CiDynamicForm extends ContentItem {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoEntityListeners(ResponseCacheClearer::getClass()), new AnnoTable('formgen_ci_dynamic_form'));
		$ai->p('dynamicForm', new AnnoManyToOne(DynamicForm::getClass()));
	}

	private $dynamicForm;

	public function createUiComponent(HtmlView $view) {
		return $view->getImport('\formgen\view\ciDynamicForm.html', array('dynamicForm' => $this->dynamicForm));
	}

	/**
	 * @return DynamicForm
	 */
	public function getDynamicForm() {
		return $this->dynamicForm;
	}

	public function setDynamicForm(DynamicForm $dynamicForm) {
		$this->dynamicForm = $dynamicForm;
	}
}