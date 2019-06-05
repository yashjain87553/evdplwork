<?php
namespace Evdpl\Emailsender\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Sales\Model\OrderNotifier;
class Sender implements ObserverInterface
{   
    const XML_NOTIFY_ENABLE = 'emailsender/general/enable';
    const XML_NOTIFY_PAYMENTMETHODS = 'emailsender/general/default_payments';
    const XML_NOTIFY_EMAILS = 'emailsender/general/accountant_email';
    protected $_customerRepositoryInterface;
    protected $order;
    protected $scopeConfig;
    protected $_transportBuilder;
    protected $_storeManager;
    protected $ordernotifier;

    public function __construct(
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface,
        \Magento\Sales\Model\Order $order,
         \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
         TransportBuilder $transportBuilder,StoreManagerInterface $storeManager,
         OrderNotifier $ordernotifier
    ) {
        $this->_customerRepositoryInterface = $customerRepositoryInterface;
        $this->order = $order;
         $this->scopeConfig = $scopeConfig;
         $this->_transportBuilder = $transportBuilder;
        $this->_storeManager = $storeManager;
        $this->ordernotifier = $ordernotifier;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $orderId = $observer->getEvent()->getOrderIds();
        $order = $this->order->load($orderId);
        $purchasedmethod=$order->getPayment()->getMethodInstance()->getCode();
         $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
         $status=$this->scopeConfig->getValue(self::XML_NOTIFY_ENABLE, $storeScope);
         if($status==1)
         {
            $notifyEmail = $this->scopeConfig->getValue(self::XML_NOTIFY_EMAILS, $storeScope);
            $paymentmethods=$this->scopeConfig->getValue(self::XML_NOTIFY_PAYMENTMETHODS, $storeScope);
            $mailsento=explode(',',$notifyEmail);
            $methods=explode(',',$paymentmethods);
            if(in_array($purchasedmethod,$methods))
            {
                $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
                foreach($mailsento as $mailid)
                {
                    $order->setCustomerEmail($mailid);
                    $this->ordernotifier->notify($order);   
                }
            }
         }
    
    }
}