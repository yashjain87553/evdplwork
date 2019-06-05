<?php
namespace Evdpl\Customtax\Model\Total\Quote;
use Magento\Checkout\Model\ConfigProviderInterface;
class Custom extends \Magento\Quote\Model\Quote\Address\Total\AbstractTotal implements ConfigProviderInterface
{
   protected $_priceCurrency;
   protected $x;
   protected $customerSession;
   public function __construct(
       \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
        \Magento\Customer\Model\Session $customerSession
   ){
       $this->_priceCurrency = $priceCurrency;
       $this->customerSession = $customerSession;
   }
   public function collect(
       \Magento\Quote\Model\Quote $quote,
       \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment,
       \Magento\Quote\Model\Quote\Address\Total $total
   )
   {
       parent::collect($quote, $shippingAssignment, $total);
       $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
       $cart = $objectManager->get('\Magento\Checkout\Model\Cart');
       $subTotal = $cart->getQuote()->getSubtotal(); 
           if($this->customerSession->getCustomer()->getCustomTax()){
           
           $baseDiscount =(($subTotal*10.5)/100);
         }
         else {
              $baseDiscount=0;
         }
          $this->x=$baseDiscount;
           $discount =  $this->_priceCurrency->convert($baseDiscount);
           $total->addTotalAmount('customdiscount', +$discount);
           $total->addBaseTotalAmount('customdiscount', +$baseDiscount);
           $total->setBaseGrandTotal($total->getBaseGrandTotal() + $baseDiscount);
           $quote->setCustomDiscount(+$discount);
       return $this;
   }
   public function getTax()
   {
   $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
   $cart = $objectManager->get('\Magento\Checkout\Model\Cart');
   $subTotal = $cart->getQuote()->getSubtotal(); 
   if($this->customerSession->getCustomer()->getCustomTax()){        
           $baseDiscount =(($subTotal*10.5)/100);
         }
         else { 
              $baseDiscount=0;
         }
    return $baseDiscount;
   }

   public function getConfig()
    {
        $config = [];
        $config['myCustomData'] = $this->getTax();

        return $config;
    }
}