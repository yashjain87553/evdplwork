<?php
namespace Evdpl\Priceformat\Block\Product;

use Magento\Catalog\Api\CategoryRepositoryInterface;

class Toprated extends \Magento\Framework\View\Element\Template
{

  protected $_imageHelper;

 protected $productCollection;

protected $urlHelper;
protected $listProductBlock;

 public function __construct(
    \Magento\Backend\Block\Template\Context $context,
    \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollection, 
    \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollection,
    \Magento\Catalog\Block\Product\ListProduct $listProductBlock,
    \Magento\Framework\Registry $registry, 
      
      
             
       
       array $data = []
    ) {
       
        $this->_productCollection = $productCollection;
       $this->_registry = $registry;
        $this->listProductBlock = $listProductBlock;
        parent::__construct($context,$data);
    }


public function getProducts()
{

    $category = $this->getCurrentCategory(); 

    $pcollection = $this->_productCollection->create()
            ->addAttributeToSelect('*')
            ->addCategoryFilter($category)    
            ->load();
    return $pcollection;

}
 public function getCurrentCategory()
    {        
        return $this->_registry->registry('current_category');
    }
    public function getLoadedProductCollection() {
        
        return $this->getProducts();
    }
     public function getAddToCartPostParams($product) {
        return $this->listProductBlock->getAddToCartPostParams($product);
    }

}