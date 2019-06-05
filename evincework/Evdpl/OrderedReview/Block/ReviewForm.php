<?php

namespace Evdpl\OrderedReview\Block;

use Magento\Framework\View\Element\Template;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\Config;
use Magento\Bundle\Model\Product\Type;
use Magento\Customer\Model\Context;
use Magento\Customer\Model\Url;
use Magento\Review\Model\ResourceModel\Rating\Collection as RatingCollection;

class ReviewForm extends Template {

    protected $request;
    protected $_helper;
    protected $_customerSession;
    protected $_careerFactory;
    protected $orderRepository;
    protected $_productloader;
    protected $_productTypeConfigurable;

    public function __construct(
    \Magento\Framework\App\Request\Http $request, Template\Context $context, \Evdpl\OrderedReview\Helper\Data $helper, \Magento\Customer\Model\Session $customerSession, \Magento\Sales\Api\OrderRepositoryInterface $orderRepository, \Magento\Catalog\Model\ProductFactory $_productloader, \Magento\Review\Model\RatingFactory $ratingFactory, \Magento\ConfigurableProduct\Model\ResourceModel\Product\Type\Configurable $catalogProductTypeConfigurable, array $data
    ) {
        $this->request = $request;
        parent::__construct($context, $data);
        $this->_helper = $helper;
        $this->_customerSession = $customerSession;
        $this->orderRepository = $orderRepository;
        $this->_productloader = $_productloader;
        $this->_ratingFactory = $ratingFactory;
        $this->_productTypeConfigurable = $catalogProductTypeConfigurable;
    }

    protected function _toHtml() {
        $html = parent::_toHtml();
        $this->unsetFormData('review_form_data');
        return $html;
    }

    public function getFormAction() {
        return $this->getUrl('orderedreview/index/post', ['_secure' => true]);
    }

    public function getFormData() {
        $formData = $this->_customerSession->getData('review_form_data');
        return $formData;
    }

    public function isCustomerLoggedIn() {
        return $this->_customerSession->isLoggedIn();
    }

    public function getCustomerId() {
        return $this->_customerSession->getCustomer()->getId();
    }

    public function getOrderId() {
        $orderId = $this->getRequest()->getParam('id');
        return $orderId;
    }

    public function getOrderData() {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $orderId = $this->getOrderId();
        $order = $objectManager->create('Magento\Sales\Model\Order')->loadByIncrementId($orderId);
        $orderItems = $order->getAllItems();
        return $orderItems;
    }

    public function getLoadProduct($id) {
        return $this->_productloader->create()->load($id);
    }

    public function getProductThumbnail($product) {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $imagewidth = 125;
        $imageheight = 125;
        $imageHelper = $objectManager->get('\Magento\Catalog\Helper\Image');
        $image_url = $imageHelper->init($product, 'product_page_image_small')->setImageFile($product->getFile())->resize($imagewidth, $imageheight)->getUrl();
        return $image_url;
    }

    public function getRatings() {
        return $this->_ratingFactory->create()->getResourceCollection()->addEntityFilter(
                        'product'
                )->setPositionOrder()->addRatingPerStoreName(
                        $this->_storeManager->getStore()->getId()
                )->setStoreFilter(
                        $this->_storeManager->getStore()->getId()
                )->setActiveFilter(
                        true
                )->load()->addOptionToItems();
    }

    public function getChildrens($product_id) {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $product = $objectManager->get('Magento\Catalog\Model\Product')->load($product_id);
        return $product->getTypeInstance()->getUsedProductIds($product);
    }

    public function getChildrenIds($parentId, $required = true) {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $product = $objectManager->get('Magento\Catalog\Model\Product')->load($parentId);
        $prod_arr = $product->getTypeInstance()->getChildrenIds($parentId);
        $main_arr = array();
        foreach ($prod_arr as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $key_1 => $value_1) {
                    $main_arr[] = $value_1;
                }
            }
        }
        return $main_arr;
    }

    public function getParentIdsByChild($childId) {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $product = $objectManager->get('Magento\Catalog\Model\Product')->load($childId);
        return $product->getTypeInstance()->getParentIdsByChild($child->getId());
    }

    public function getProductData($id) {  // pass child product id in this function
        $parent_id = "";
        $parentByChild = $this->_productTypeConfigurable->getParentIdsByChild($id);
        if (isset($parentByChild[0])) {
            $parent_id = $parentByChild[0]; //here you will get parent product id
        }
        return $parent_id;
    }

}
