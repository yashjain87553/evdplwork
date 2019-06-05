<?php

namespace Evdpl\Priceformat\Plugins;
use Magento\Catalog\Model\ProductRepository;
use \Magento\ConfigurableProduct\Model\Product\Type\Configurable;

class Url{

    protected $_configurableProductInstance;
    protected $_productRepository;

    function __construct(
        Configurable $configurable,
        ProductRepository $productRepository
    )
    {
        $this->_configurableProductInstance = $configurable;
        $this->_productRepository = $productRepository;
    }

    public function beforegetProductUrl(\Magento\Catalog\Model\Product\Url $subject, \Magento\Catalog\Model\Product $product, $useSid)
    {
        $parentId = $this->_configurableProductInstance->getParentIdsByChild($product->getId());
        if(count($parentId)){
            return [$this->_productRepository->getById($parentId[0]), $useSid];
        }
        return null;
    }
}