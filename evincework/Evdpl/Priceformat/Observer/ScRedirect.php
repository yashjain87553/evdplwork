<?php

    namespace Eharvest\ScRedirect\Observer;
    use Magento\Framework\Event\ObserverInterface;
    use Magento\Framework\Event\Observer;

    class ScRedirect implements ObserverInterface {

        protected $_catalogProductTypeConfigurable;
        protected $_productloader;

        public function __construct(
            \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $_productloader,
            \Magento\Catalog\Block\Product\Context $context,
            \Magento\ConfigurableProduct\Model\ResourceModel\Product\Type\Configurable $catalogProductTypeConfigurable,
            \Magento\Catalog\Model\Session $catalogSession,
            \Magento\Framework\App\ResponseFactory $responseFactory,
            \Magento\Framework\UrlInterface $url,
            \Magento\Catalog\Model\ProductRepository $productRepository
        ){
            $this->_request = $context->getRequest();
            $this->_productloader = $_productloader;
            $this->_catalogProductTypeConfigurable = $catalogProductTypeConfigurable;
            $this->_catalogSession = $catalogSession;
            $this->_responseFactory = $responseFactory;
            $this->_url = $url;
            $this->_productRepository = $productRepository;
        }

        public function execute(\Magento\Framework\Event\Observer $observer ) {
            $simpleProductId = $this->_request->getParam('id');
            $simpleProduct = $this->_productRepository->getById($simpleProductId);
            $configProductId = $this->_catalogProductTypeConfigurable->getParentIdsByChild($simpleProductId);
            if(isset($configProductId [0])){
                $parentId = $configProductId[0];
                $configProduct = $this->_productRepository->getById($parentId);
                $configProductUrl = $configProduct->getUrlModel()->getUrl($configProduct);
$this->_responseFactory->create()->setRedirect($configProductUrl)->sendResponse();
                die();
            }
        }
    }