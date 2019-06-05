<?php

namespace Evdpl\CustomTax\Model\Invoice\Total;

use Magento\Sales\Model\Order\Invoice\Total\AbstractTotal;

class customtax extends AbstractTotal
{
    /**
     * @param \Magento\Sales\Model\Order\Invoice $invoice
     * @return $this
     */
    public function collect(\Magento\Sales\Model\Order\Invoice $invoice)
    {
        $invoice->setCustomTax(0);
      /*  $invoice->setBaseFee(0);*/

        $amount = $invoice->getOrder()->getCustomTax();
        $invoice->setCustomTax($amount);
       /* $amount = $invoice->getOrder()->getBaseFee();
        $invoice->setBaseFee($amount);*/

        $invoice->setGrandTotal($invoice->getGrandTotal() + $invoice->getCustomTax());
        /*$invoice->setBaseGrandTotal($invoice->getBaseGrandTotal() + $invoice->getFee());*/

        return $this;
    }
}
