<?php
namespace Evdpl\CustomTax\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

class AddTaxToOrderObserver implements ObserverInterface
{
    /**
     * Set payment fee to order
     *
     * @param EventObserver $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $quote = $observer->getQuote();
        $CustomTax = $quote->getCustomTax();
        /*$CustomFeeBaseFee = $quote->getBaseFee();*/
        if (!$CustomTax /*|| !$CustomFeeBaseFee*/) {
            return $this;
        }
        //Set fee data to order
        $order = $observer->getOrder();
        $order->setData('custom_tax', $CustomTax);
        /*$order->setData('base_fee', $CustomFeeBaseFee);*/

        return $this;
    }
}
