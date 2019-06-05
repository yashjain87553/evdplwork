<?php
namespace Evdpl\Dailydeals\Block;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Model\ResourceModel\Product\Collection;
use Magento\Framework\App\ActionInterface;

class Dailydeals extends \Magento\Catalog\Block\Product\ListProduct
{
    protected $_collection;
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Framework\Data\Helper\PostHelper $postDataHelper,
        \Magento\Catalog\Model\Layer\Resolver $layerResolver,
        CategoryRepositoryInterface $categoryRepository,
        \Magento\Framework\Url\Helper\Data $urlHelper,
        Collection $collection,
        array $data = []
    ) {
        $this->imageBuilder = $context->getImageBuilder();
        $this->_collection = $collection;
        parent::__construct(
                $context,
                $postDataHelper,
                $layerResolver,
                $categoryRepository,
                $urlHelper,
                $data
                );
    }
    protected function getProducts() {
        $currentdate=date('Y-m-d')." 00:00:00";
        $collection = $this->_collection
                ->addMinimalPrice()
                ->addFinalPrice()
                ->addTaxPercents()
                ->addAttributeToSelect('*')
                ->addAttributeToFilter('is_daily_deal',1);
                
        $collection->getSelect()
                ->order('rand()');

        $pager = $this->getLayout()
                ->createBlock(
                        'Magento\Theme\Block\Html\Pager')
                ->setCollection($collection);
        $this->setChild('pager', $pager);

        $this->_productCollection = $collection;
        return $this->_productCollection;
    }

    public function getLoadedProductCollection() {
        return $this->getProducts();
    }

    public function getToolbarHtml() {
        return $this->getChildHtml('pager');
    }

    public function getMode() {
        return 'grid';
    }

    public function getImageHelper() {
        return $this->_imageHelper;
    }

    public function getAddToCartPostParams(
        \Magento\Catalog\Model\Product $product
    ) {
        $url = $this->getAddToCartUrl($product);
        return [
            'action' => $url,
            'data' => [
                'product' => $product->getEntityId(),
                ActionInterface::PARAM_NAME_URL_ENCODED =>
                $this->urlHelper->getEncodedUrl($url),
            ]
        ];
    }
}
