<?php

namespace Evdpl\Priceformat\Block\Product;

use Magento\Catalog\Api\CategoryRepositoryInterface;

class NewProductsList extends \Magento\Framework\View\Element\Template {

    protected $_productCollectionFactory;
    protected $_registry;
    protected $_stockItemRepository;

    public function __construct(
    \Magento\Backend\Block\Template\Context $context, \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory, \Magento\Catalog\Model\Product\Visibility $catalogProductVisibility, \Magento\Catalog\Model\ResourceModel\Product\Collection $collection, \Magento\CatalogInventory\Model\Stock\StockItemRepository $stockItemRepository, \Magento\Framework\Registry $registry, \Magento\Catalog\Block\Product\ListProduct $listProductBlock, array $data = []
    ) {
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_catalogProductVisibility = $catalogProductVisibility;
        $this->_stockItemRepository = $stockItemRepository;
        $this->_collection = $collection;
        $this->_registry = $registry;
        $this->listProductBlock = $listProductBlock;
        parent::__construct($context, $data);
    }

    public function getProducts() {

        $todayStartOfDayDate = $this->_localeDate->date()->setTime(0, 0, 0)->format('Y-m-d H:i:s');
        $todayEndOfDayDate = $this->_localeDate->date()->setTime(23, 59, 59)->format('Y-m-d H:i:s');

        $category = $this->getCurrentCategory();


        /** @var $collection \Magento\Catalog\Model\ResourceModel\Product\Collection */
        $collection = $this->_productCollectionFactory->create();
        $collection->setVisibility($this->_catalogProductVisibility->getVisibleInCatalogIds());


        $collection = $this->_collection
                        ->addMinimalPrice()
                        ->addFinalPrice()
                        ->addTaxPercents()
                        ->addAttributeToSelect('name')
                        ->addAttributeToSelect('image')
                        ->addAttributeToSelect('news_from_date')
                        ->addAttributeToSelect('news_to_date')
                        ->addAttributeToSelect('special_price')
                        ->addAttributeToSelect('special_from_date')
                        ->addAttributeToSelect('special_to_date')
                        ->addAttributeToSelect('discount')
                        ->addCategoryFilter($category)
                        ->addAttributeToFilter(
                                'news_from_date', [
                            'or' => [
                                0 => ['date' => true, 'to' => $todayEndOfDayDate],
                                1 => ['is' => new \Zend_Db_Expr('null')],
                            ]
                                ], 'left'
                        )->addAttributeToFilter(
                                'news_to_date', [
                            'or' => [
                                0 => ['date' => true, 'from' => $todayStartOfDayDate],
                                1 => ['is' => new \Zend_Db_Expr('null')],
                            ]
                                ], 'left'
                        )->addAttributeToFilter(
                                [
                                    ['attribute' => 'news_from_date', 'is' => new \Zend_Db_Expr('not null')],
                                    ['attribute' => 'news_to_date', 'is' => new \Zend_Db_Expr('not null')],
                                ]
                        )
                        ->addAttributeToFilter('status', 1)
                        ->addAttributeToFilter('visibility', 4)
                        ->addAttributeToSort(
                                'news_from_date', 'desc'
                        )->setPageSize(4);

        $collection->getSelect();



        $this->_productCollection = $collection;
        return $this->_productCollection;
    }

    public function getCurrentCategory() {
        return $this->_registry->registry('current_category');
    }

    /*
     * Load and return product collection 
     */

    public function getLoadedProductCollection() {
        return $this->getProducts();
    }

    public function getStockItem($productId) {
        return $this->_stockItemRepository->get($productId);
    }

    public function getAddToCartPostParams($product) {
        return $this->listProductBlock->getAddToCartPostParams($product);
    }

}
