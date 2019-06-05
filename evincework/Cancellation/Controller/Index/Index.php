<?php

namespace Evdpl\Cancellation\Controller\Index;
 
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Sales\Model\Order;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
 
class Index extends \Magento\Framework\App\Action\Action
{
    protected $_resultPageFactory;
    protected $order;
    protected $_request;
    protected $_transportBuilder;
    protected $_storeManager;

    public function __construct(Context $context, PageFactory $resultPageFactory,Order $order,Http $request,TransportBuilder $transportBuilder,StoreManagerInterface $storeManager,ScopeConfigInterface $scopeConfig)
    {
        $this->_resultPageFactory = $resultPageFactory;
        $this->order= $order;
        $this->_request = $request;
        $this->_transportBuilder = $transportBuilder;
        $this->_storeManager = $storeManager;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }
 
    public function execute()
    {     
      $salesemail = $this->scopeConfig->getValue('trans_email/ident_sales/email',ScopeInterface::SCOPE_STORE);
      $salesname  = $this->scopeConfig->getValue('trans_email/ident_sales/name',ScopeInterface::SCOPE_STORE);

    
      $orderid=$_GET['orderid'];
      $order=$this->order->load($orderid); 
      $order->setState("canceled")->setStatus("canceled");
      $order->save();
      $customeremail=$order->getCustomerEmail();
      $customername=$order->getCustomerName();
     
      $store = $this->_storeManager->getStore()->getId();
      $transport = $this->_transportBuilder->setTemplateIdentifier(1)
            ->setTemplateOptions(['area' => 'frontend', 'store' => $store])
            ->setTemplateVars(
                [
                    'store' => $this->_storeManager->getStore(),
                    'order' => $order,
                ]
            )
            ->setFrom('general')
            ->addTo($customeremail, $customername)
            ->getTransport();
      $transport->sendMessage();
      $transport = $this->_transportBuilder->setTemplateIdentifier(2)
            ->setTemplateOptions(['area' => 'frontend', 'store' => $store])
            ->setTemplateVars(
                [
                    'store' => $this->_storeManager->getStore(),
                    'order' => $order,
                ]
            )
            ->setFrom('general')
            ->addTo($salesemail, $salesname)
            ->getTransport();
      $transport->sendMessage();
      $this->messageManager->addSuccess(__('The Order has been Cancelled.'));
      $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
      $resultRedirect->setUrl($this->_redirect->getRefererUrl());
       return $resultRedirect;  
    }
}