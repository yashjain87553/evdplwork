<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Whatsapp subscribe block
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
namespace Evince\Whatsapp\Block;
/*
use Magento\Framework\View\Element\Template;*/

use Magento\Catalog\Model\Product;
use Magento\Framework\Pricing\SaleableInterface;
use Magento\Framework\Pricing\Render as PricingRender;
class Whatsapp extends \Magento\Framework\View\Element\Template
{

    /**
     * Retrieve form action url and set "secure" param to avoid confirm
     * message when we submit form from secure page to unsecure
     *
     * @return string
     */

    protected $_product;
    protected $category;
    protected $_productCollectionFactory;
    protected $objectManager;
     public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }
      public function getProduct()
    {
        if (!$this->_product) {
            $this->_product = $this->_coreRegistry->registry('product');
        }
        return $this->_product;
    }
}
