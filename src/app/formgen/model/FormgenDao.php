<?php
namespace formgen\model;

use n2n\context\RequestScoped;
use n2n\persistence\orm\EntityManager;
use formgen\bo\DynamicForm;

class FormgenDao implements RequestScoped {
	private $em;
	
	private function _init(EntityManager $em) {
		$this->em = $em;
	}
	
	/**
	 * @param string $id
	 * @return DynamicForm
	 */
	public function getDynamicFormById(string $id) {
		return $this->em->createSimpleCriteria(DynamicForm::getClass(), array('id' => $id))->toQuery()->fetchSingle();
	}
}