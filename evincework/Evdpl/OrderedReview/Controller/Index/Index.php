<?php

namespace Evdpl\OrderedReview\Controller\Index;

use Evdpl\OrderedReview\Helper\Data;
//use Evdpl\Career\Model\CareerFactory;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\RequestInterface;

class Index extends Action {

    
    protected $_pageFactory;
    private $customerSession;
    
    protected $_dataHelper;

   
    protected $_careerFactory;

    public function __construct(
    Context $context, PageFactory $pageFactory, Data $dataHelper, Session $customerSession
    ) {
        parent::__construct($context);
        $this->_pageFactory = $pageFactory;
        $this->_dataHelper = $dataHelper;
        $this->customerSession = $customerSession;
        //$this->_careerFactory = $careerFactory;
    }

    public function execute() {
        
        //$resultRedirect->setPath('customer/account/login/');
        $resultPage = $this->_pageFactory->create();
        if (!$this->customerSession->isLoggedIn()) {
            $this->_redirect('customer/account/login/');
            $this->messageManager->addError(__('Please login to post review for your order.'));
        }
        $resultPage->getConfig()->getTitle()->set('Order Review');
        return $resultPage;
    }

}
