<?php
namespace Evdpl\CustomTax\Plugin\Checkout\Model;


class ShippingInformationManagement
{
    /**
     * @var \Magento\Quote\Model\QuoteRepository
     */
    protected $quoteRepository;

    /**
     * @var \Evdpl\CustomFee\Helper\Data
     */
    protected $dataHelper;

    /**
     * @param \Magento\Quote\Model\QuoteRepository $quoteRepository
     * @param \Evdpl\CustomFee\Helper\Data $dataHelper
     */
    public function __construct(
        \Magento\Quote\Model\QuoteRepository $quoteRepository,
        \Evdpl\CustomTax\Helper\Data $dataHelper
    )
    {
        $this->quoteRepository = $quoteRepository;
        $this->dataHelper = $dataHelper;
    }

    /**
     * @param \Magento\Checkout\Model\ShippingInformationManagement $subject
     * @param $cartId
     * @param \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
     */
    public function beforeSaveAddressInformation(
        \Magento\Checkout\Model\ShippingInformationManagement $subject,
        $cartId,
        \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
    )
    {
         $quote = $this->quoteRepository->getActive($cartId);
        $CustomTax = $this->dataHelper->getCustomTax();
            $quote->setCustomTax($CustomTax);
       /* $CustomTax = $addressInformation->getExtensionAttributes()->getCustomTax();
        $quote = $this->quoteRepository->getActive($cartId);
        if ($CustomTax) {
            $CustomTax = $this->dataHelper->getCustomTax();
            $quote->setCustomTax($CustomTax);
        } else {
            $quote->setCustomTax(NULL);
        }*/
    }
}

