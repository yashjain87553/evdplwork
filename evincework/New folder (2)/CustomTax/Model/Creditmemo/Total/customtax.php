<?php

namespace Evdpl\CustomTax\Model\Creditmemo\Total;

use Magento\Sales\Model\Order\Creditmemo\Total\AbstractTotal;

class customtax extends AbstractTotal
{
    /**
     * @param \Magento\Sales\Model\Order\Creditmemo $creditmemo
     * @return $this
     */
    public function collect(\Magento\Sales\Model\Order\Creditmemo $creditmemo)
    {
        $creditmemo->setCustomTax(0);
      /*  $creditmemo->setBaseFee(0);*/

        $amount = $creditmemo->getOrder()->getCustomTax();
        $creditmemo->setCustomTax($amount);

      /*  $amount = $creditmemo->getOrder()->getBaseFee();
        $creditmemo->setBaseFee($amount);*/

        $creditmemo->setGrandTotal($creditmemo->getGrandTotal() + $creditmemo->getCustomTax());
        /*$creditmemo->setBaseGrandTotal($creditmemo->getBaseGrandTotal() + $creditmemo->getBaseFee());*/

        return $this;
    }
}
