<?php
class TermsOfService_IndexController extends  Omeka_Controller_AbstractActionController {	
	
	public function indexAction() {
		return $this->_forward('tos');
	}
		
	public function tosAction() {		

	}
	
	public function privacyPolicyAction() {

	}
}