<?php
namespace Evdpl\CustomTax\Model;

use Magento\Checkout\Model\ConfigProviderInterface;

class CustomTaxConfigProvider implements ConfigProviderInterface
{
    /**
     * @var \Evdpl\CustomFee\Helper\Data
     */
    protected $dataHelper;

    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $checkoutSession;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @param \Evdpl\CustomFee\Helper\Data $dataHelper
     * @param \Magento\Checkout\Model\Session $checkoutSession
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Evdpl\CustomTax\Helper\Data $dataHelper,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Psr\Log\LoggerInterface $logger

    )
    {
        $this->dataHelper = $dataHelper;
        $this->checkoutSession = $checkoutSession;
        $this->logger = $logger;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        $customTaxConfig = [];
        /*$enabled = $this->dataHelper->isModuleEnabled();
        $minimumOrderAmount = $this->dataHelper->getMinimumOrderAmount();*/
        /*$customFeeConfig['fee_label'] = $this->dataHelper->getFeeLabel();*/
       /* $quote = $this->checkoutSession->getQuote();*/
        /*$subtotal = $quote->getSubtotal();*/
        $customTaxConfig['myCustomData'] = $this->dataHelper->getCustomTax();
       /* $customFeeConfig['show_hide_customfee_block'] = ($enabled && ($minimumOrderAmount <= $subtotal) && $quote->getFee()) ? true : false;
        $customFeeConfig['show_hide_customfee_shipblock'] = ($enabled && ($minimumOrderAmount <= $subtotal)) ? true : false;*/
        return $customTaxConfig;
    }
}
