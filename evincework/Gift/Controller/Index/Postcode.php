<?php
namespace Evince\Gift\Controller\Index;

use Magento\Framework\App\Action\Context;


class Postcode extends \Magento\Framework\App\Action\Action
{   

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var \Magento\Framework\Json\Helper\Data
     */

    protected $jsonData;
	protected $layoutFactory;
	
    
	/**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory resultPageFactory
    */

    public function __construct(Context $context,\Magento\Framework\View\Result\PageFactory $resultPageFactory,
	\Magento\Framework\Json\Helper\Data $jsonData,
	\Magento\Framework\View\LayoutFactory $layoutFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
	
        $this->jsonData = $jsonData;
		$this->layoutFactory = $layoutFactory;
        parent::__construct($context);
    }
	
	
    public function execute()
    {         
	  $postcode = $this->getRequest()->getParam('postcode');
	
	  $om = \Magento\Framework\App\ObjectManager::getInstance(); 
	  
	
	

	  $session = $om->get('Magento\Customer\Model\Session');
	  $session->setPostcodeKey($postcode);
		
		 
		
		
		
		 
		echo $postcode;
	  //echo $session->getGiftKey();
	  exit;
    }
}