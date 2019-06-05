<?php

namespace Evdpl\CustomTax\Model\Total;

use Magento\Store\Model\ScopeInterface;

class customtax extends \Magento\Quote\Model\Quote\Address\Total\AbstractTotal
{

    protected $helperData;

    /**
     * Collect grand total address amount
     *
     * @param \Magento\Quote\Model\Quote $quote
     * @param \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment
     * @param \Magento\Quote\Model\Quote\Address\Total $total
     * @return $this
     */
    protected $quoteValidator = null;

    public function __construct(\Magento\Quote\Model\QuoteValidator $quoteValidator,
                                \Evdpl\CustomTax\Helper\Data $helperData)
    {
        $this->quoteValidator = $quoteValidator;
        $this->helperData = $helperData;
    }

    public function collect(
        \Magento\Quote\Model\Quote $quote,
        \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment,
        \Magento\Quote\Model\Quote\Address\Total $total
    )
    {
        parent::collect($quote, $shippingAssignment, $total);
       /* if (!count($shippingAssignment->getItems())) {
            return $this;
        }*/

       /* $enabled = $this->helperData->isModuleEnabled();
        $minimumOrderAmount = $this->helperData->getMinimumOrderAmount();*/
        $subtotal = $total->getTotalAmount('subtotal');
        if (1==1) {
            $CustomTax = $quote->getCustomTax();
            $total->setTotalAmount('Custom_tax', $CustomTax);
            /*$total->setBaseTotalAmount('fee', $fee);*/
            $total->setCustomTax($CustomTax);
            /*$total->setBaseFee($fee);*/
            $quote->setCustomTax($CustomTax);
            /*$quote->setBaseFee($fee);*/
            $total->setGrandTotal($total->getGrandTotal() + $CustomTax);
           /* $total->setBaseGrandTotal($total->getBaseGrandTotal() + $fee);*/
        }
        return $this;
    }

    /**
     * @param \Magento\Quote\Model\Quote $quote
     * @param \Magento\Quote\Model\Quote\Address\Total $total
     * @return array
     */
    public function fetch(\Magento\Quote\Model\Quote $quote, \Magento\Quote\Model\Quote\Address\Total $total)
    {

        /*$enabled = $this->helperData->isModuleEnabled();
        $minimumOrderAmount = $this->helperData->getMinimumOrderAmount();*/
        $subtotal = $quote->getSubtotal();
        $CustomTax = $quote->getCustomTax();
        if ( $CustomTax) {
            return [
                'code' => 'custom_tax',
                'title' => 'Customtax',
                'value' => $CustomTax
            ];
        } else {
            return array();
        }
    }

    /**
     * Get Subtotal label
     *
     * @return \Magento\Framework\Phrase
     */
    /*public function getLabel()
    {
        return __('Custom Fee');
    }*/

    /**
     * @param \Magento\Quote\Model\Quote\Address\Total $total
     */
    protected function clearValues(\Magento\Quote\Model\Quote\Address\Total $total)
    {
       // $enabled = $this->helperData->isModuleEnabled();
       // $minimumOrderAmount = $this->helperData->getMinimumOrderAmount();
       // $subtotal = $total->getTotalAmount('subtotal');
        $total->setTotalAmount('subtotal', 0);
        /*$total->setBaseTotalAmount('subtotal', 0);*/
        $total->setTotalAmount('tax', 0);
       /* $total->setBaseTotalAmount('tax', 0);*/
        $total->setTotalAmount('discount_tax_compensation', 0);
        /*$total->setBaseTotalAmount('discount_tax_compensation', 0);*/
        $total->setTotalAmount('shipping_discount_tax_compensation', 0);
        /*$total->setBaseTotalAmount('shipping_discount_tax_compensation', 0);*/
        $total->setSubtotalInclTax(0);
/*        $total->setBaseSubtotalInclTax(0);*/

    }
}
