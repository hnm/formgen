<?php
namespace formgen\model;

use n2nutil\bootstrap\ui\Bs;
use n2nutil\bootstrap\ui\BsComposer;
use n2n\web\http\Request;
use n2n\util\uri\Url;
use formgen\bo\DynamicForm;
use n2n\context\RequestScoped;
use formgen\controller\FormgenController;
use n2n\core\container\N2nContext;

class FormgenConfig implements RequestScoped {
	private $bsComposer;
	private $templateViewId;
	private $formSubmitUrl;
	private $formLegendClassName;
	
	private function _init(Request $request, N2nContext $n2nContext) {
		$this->bsComposer = Bs::row('col-sm-4', 'col-sm-8', 'offset-sm-4');
		$this->templateViewId = '\formgen\view\dynamicFormTemplate.html';
		
		if ($n2nContext->getModuleManager()->containsModuleNs('bstmpl')) {
			$this->templateViewId = '\bstmpl\view\bstemplate.html';
		}
		
		$this->formSubmitUrl = $request->getContextPath()->ext(
				array($request->getN2nLocale(), FormgenController::PATH))->toUrl();
		$this->formLegendClassName = 'col-form-label';
	}
	
	public function setBsComponser(BsComposer $bsComposer) {
		$this->bsComposer = $bsComposer;
	}
	
	public function getBsComposer() {
		return $this->bsComposer;
	}
	
	public function setTemplateViewId(string $templateViewId) {
		$this->templateViewId = $templateViewId;
	}
	
	public function getTemplateViewId() {
		return $this->templateViewId;
	}
	
	public function setFormSubmitUrl(Url $formSubmitUrl) {
		$this->formSubmitUrl = $formSubmitUrl;
	}
	
	public function buildFormSubmitUrl(DynamicForm $dynamicForm) {
		return $this->formSubmitUrl->extR(null, array('f' => $dynamicForm->getId()));
	}
	
	public function getFormLegendClassName() {
		return $this->formLegendClassName;
	}
	
	public function setFormLegendClassName(string $formLegendClassName) {
		$this->formLegendClassName = $formLegendClassName;
	}
}