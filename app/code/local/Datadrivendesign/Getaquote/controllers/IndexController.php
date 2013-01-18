<?php
class Datadrivendesign_Getaquote_IndexController extends Mage_Core_Controller_Front_Action
{
	public function indexAction()
	{
		$this->loadLayout();        
		$this->renderLayout();
	}
	
	public function successAction()
	{
		$this->loadLayout();        
		$this->renderLayout();
	}
	
	const EMAIL_TEMPLATE_XML_PATH = 'customer/getaquote/getaquote_email_template';
	public function sendEmailAction()
	{
		// Get POST vars
		$postData = Mage::app()->getRequest()->getPost();	
		
		// Set email template ID and set values
		$templateId = 1;
		$mailSubject = 'Get a Quote';		
		$sender = array(
			'name'	=>	'leads',
			'email'	=>	'leads@landanorthwest.com'
		);
		
		// Set email values using post data
		$recepientEmail = 'leads@landanorthwest.com';		
		$recepientName = 'Sales';	
		$vars = array(
			'firstName'		=>	$postData['firstName'],
			'lastName'		=>	$postData['lastName'],
			'company'		=>	$postData['company'],
			'zipCode'		=>	$postData['zipCode'],
			'customerEmail'	=>	$postData['email'],
			'telephone'		=>	$postData['telephone'],
			'productName'	=>	$postData['productName'],
			'productSku'	=>	$postData['productSku'],
			'comment'		=>	$postData['comment']			
		);
		
	    $translate = Mage::getSingleton('core/translate');
		
		Mage::getModel('core/email_template')
			->setTemplateSubject($mailSubject)
			->sendTransactional($templateId, $sender, $recepientEmail, $recepientName, $vars);
		
		$translate->setTranslateInline(true);		
	
		$this->_redirect('*/*/success');
	}
}