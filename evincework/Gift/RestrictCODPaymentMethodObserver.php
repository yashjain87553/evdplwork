<?php
/**
 *
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magearc\Codrestrict\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer as EventObserver;

class RestrictCODPaymentMethodObserver implements ObserverInterface
{
    protected $_helperData;
    protected $_session;

    public function __construct(\Magearc\Codrestrict\Helper\Data $helper,\Magento\Checkout\Model\Session $session) {
        $this->_helperData = $helper;
        $this->_session = $session;
    }

    public function execute(EventObserver $observer)
    {
        $event = $observer->getEvent();
        $method = $event->getMethodInstance();
        $result = $event->getResult();
        $isModuleEnable = $this->_helperData->isModuleEnabled();

         $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $cart = $objectManager->get('\Magento\Checkout\Model\Cart'); 
        $itemsCollection = $cart->getQuote()->getItemsCollection();
        $items = $cart->getQuote()->getAllItems();
        foreach($items as $item) 
        {
           
            $_product = $objectManager->get('Magento\Catalog\Model\Product')->load($item->getProductId());  
            $availabilitycode[] =$_product->getResource()->getAttribute('cod_available')->getFrontend()->getValue($_product);
        }
        
        if($isModuleEnable) {
            if($method->getCode() == 'cashondelivery' ){

                $quote = $this->_session->getQuote();
                $address = $quote->isVirtual() ? $quote->getBillingAddress() : $quote->getShippingAddress();
                $postcode = $address->getData('postcode');
                $cod_ZipCodes = $this->_helperData->getCODPincodes();
                
                if(in_array($postcode, $cod_ZipCodes) && in_array("Yes",$availabilitycode)) {
                    $minimum_order_amount = $this->_helperData->getMinimumOrderTotal();
                    $maximum_order_amount = $this->_helperData->getMaximumOrderTotal();
                    $subtotal = $quote->getSubtotal();

                    if(!empty($minimum_order_amount) && !empty($maximum_order_amount) && $subtotal > $minimum_order_amount && $subtotal < $maximum_order_amount) {
                        $result->setData('is_available', false);
                    }
                    else if(!empty($minimum_order_amount) && $subtotal > $minimum_order_amount) {
                        $result->setData('is_available', false);   
                    }
                    else if(!empty($maximum_order_amount) && $subtotal < $maximum_order_amount) {
                        $result->setData('is_available', false);   
                    }
                    else {
                        $result->setData('is_available', false);   
                    }
                }
            }   
        }
    }
}
