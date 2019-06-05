<?php

namespace Evdpl\Priceformat\Block\Product;

use Magento\Catalog\Api\CategoryRepositoryInterface;

class BestsellerList extends \Magento\Framework\View\Element\Template {

    /**
     * Product collection model
     *
     * @var Magento\Catalog\Model\Resource\Product\Collection
     */
    protected $_collection;

    /**
     * Product collection model
     *
     * @var Magento\Catalog\Model\Resource\Product\Collection
     */
    protected $_productCollection;

    /**
     * Image helper
     *
     * @var Magento\Catalog\Helper\Image
     */
    protected $_imageHelper;

    /**
     * Catalog Layer
     *
     * @var \Magento\Catalog\Model\Layer\Resolver
     */
    protected $_catalogLayer;

    /**
     * @var \Magento\Framework\Data\Helper\PostHelper
     */
    protected $_postDataHelper;

    /**
     * @var \Magento\Framework\Url\Helper\Data
     */
    protected $urlHelper;

    /**
     * @var \Magento\Catalog\Helper\Image
     */
    protected $imageHelper;

    /**
     * @var \Magento\Catalog\Helper\Image
     */
    protected $_scopeConfig;

    /**
     * @var \Magento\Catalog\Api\CategoryRepositoryInterface
     */
    protected $categoryRepository;
    protected $_registry;

    /**
     * Initialize
     *
     * @param \Magento\Catalog\Block\Product\Context $context
     * @param \Magento\Framework\Data\Helper\PostHelper $postDataHelper
     * @param \Magento\Catalog\Model\Layer\Resolver $layerResolver
     * @param \CategoryRepositoryInterface $categoryRepository
     * @param \Magento\Framework\Url\Helper\Data $urlHelper
     * @param \Magento\Catalog\Model\ResourceModel\Product\Collection $collection
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Catalog\Helper\Image $imageHelper
     * @param array $data
     */
    public function __construct(
    \Magento\Catalog\Block\Product\Context $context, CategoryRepositoryInterface $categoryRepository, \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollection, \Magento\CatalogInventory\Model\Stock\StockItemRepository $stockItemRepository, \Magento\Catalog\Model\ResourceModel\Product\Collection $collection, \Magento\Framework\Registry $registry, \Magento\Catalog\Block\Product\ListProduct $listProductBlock, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, array $data = []
    ) {

        $this->categoryRepository = $categoryRepository;
        $this->_registry = $registry;

        $this->_collection = $collection;
        $this->_stockItemRepository = $stockItemRepository;
        $this->_scopeConfig = $scopeConfig;

        parent::__construct($context, $data);
        $this->listProductBlock = $listProductBlock;
    }

    /**
     * Get product collection
     */
    protected function getProducts() {
        $limit = 4;
        $category = $this->getCurrentCategory();
        $sortby = 'rand()';
        $storeId = 0;
        $category = $this->getCurrentCategory();
        $fromDate = $this->_scopeConfig->getValue('bestsellerproducts_settings/bestseller_products/startdate', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $toDate = $this->_scopeConfig->getValue('bestsellerproducts_settings/bestseller_products/enddate', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

        $sqlQuery = "e.entity_id = aggregation.product_id";
        if ($storeId > 0) {
            $sqlQuery .= " AND aggregation.store_id={$storeId}";
        }
        if ($fromDate != '' && $toDate != '') {
            $sqlQuery .= " AND aggregation.period BETWEEN '{$fromDate}' AND '{$toDate}'";
        }
        $this->_collection->clear()->getSelect()->reset('where');
          $collection = $this->_collection
          ->addCategoryFilter($category)
          ->addMinimalPrice()
          ->addFinalPrice()
          ->addTaxPercents()
          ->addAttributeToSelect('name')
          ->addAttributeToSelect('image')
          ->addAttributeToSelect('news_from_date')
          ->addAttributeToSelect('news_to_date')
          ->addAttributeToSelect('special_price')
          ->addAttributeToSelect('special_from_date')
          ->addAttributeToSelect('special_to_date'); 
        /* ->addAttributeToFilter('is_saleable', 1, 'left')
          ->addAttributeToFilter('status', 1)
          ->addAttributeToFilter('visibility', 4); */

             $collection->getSelect()->joinRight(
          array('aggregation' => 'sales_bestsellers_aggregated_monthly'),
          $sqlQuery,
          array('SUM(aggregation.qty_ordered) AS sold_quantity')
          )->group('e.entity_id')->order('sold_quantity DESC')->limit($limit);

          $collection->getSelect();
          /*$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $productCollection = $objectManager->create('Magento\Reports\Model\ResourceModel\Product\CollectionFactory');
        $collection = $productCollection->create()->addAttributeToSelect('*');
        $collection->addStoreFilter()
                ->joinField(
                        'qty_ordered', 'sales_bestsellers_aggregated_monthly', 'qty_ordered', 'product_id=entity_id', 'at_qty_ordered.store_id=' . $storeId, 'at_qty_ordered.qty_ordered > 0', 'left'
        );
        */
        $this->_productCollection = $collection;
        return $this->_productCollection;
    }

    public function getCurrentCategory() {
        return $this->_registry->registry('current_category');
    }

    /*
     * Load and return product collection 
     */

    public function getStartDate() {
        return $this->_scopeConfig->getValue('bestsellerproducts_settings/bestseller_products/startdate', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        /* $myDateTime = DateTime::createFromFormat('d/m/Y', $date);
          return  $newDateString = $myDateTime->format('Y-M-D'); */
    }

    public function getEndDate() {
        return $this->_scopeConfig->getValue('bestsellerproducts_settings/bestseller_products/enddate', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

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
