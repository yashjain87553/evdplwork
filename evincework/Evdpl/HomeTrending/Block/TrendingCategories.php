<?php

namespace Evdpl\HomeTrending\Block;

class TrendingCategories extends \Magento\Framework\View\Element\Template {

    protected $_categoryHelper;
    protected $categoryFlatConfig;
    protected $topMenu;
    protected $_categoryCollection;
    protected $_productCollectionFactory;
    protected $_categoryFactory;

    /**     * @param \Magento\Framework\View\Element\Template\Context $context 
     * * @param \Magento\Catalog\Helper\Category $categoryHelper 
     * * @param array $data */
    public function __construct(\Magento\Framework\View\Element\Template\Context $context, 
            \Magento\Catalog\Helper\Category $categoryHelper, 
            \Magento\Catalog\Model\Indexer\Category\Flat\State $categoryFlatState, 
            \Magento\Theme\Block\Html\Topmenu $topMenu, 
            \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollection,
            \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
    \Magento\Catalog\Model\CategoryFactory $categoryFactory) {
        $this->_categoryHelper = $categoryHelper;
        $this->_categoryCollection = $categoryCollection;
        $this->_categoryFactory = $categoryFactory;
    $this->_productCollectionFactory = $productCollectionFactory;
        parent::__construct($context);
    }

    /**
     * Return categories helper
     */
    public function getCategoryHelper() {
        return $this->_categoryHelper;
    }

    public function getCategoryCollection() {
        $collection = $this->_categoryCollection->create()
                ->addAttributeToSelect('*')
                ->addAttributeToFilter('trending_on_home', 1);


        return $collection;
    }

    public function getProductCollection($categoryId) {
        //$categoryId = 3;
        $category = $this->_categoryFactory->create()->load($categoryId);
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addCategoryFilter($category);
        $collection->addAttributeToFilter('visibility', \Magento\Catalog\Model\Product\Visibility::VISIBILITY_BOTH);
        $collection->addAttributeToFilter('status', \Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED);
        $collection->setPageSize(3);
        return $collection;
    }

}
