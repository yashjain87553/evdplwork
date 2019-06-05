<?php

namespace Evdpl\Productlabel\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Store\Model\StoreManagerInterface;

class productlogo extends \Magento\Ui\Component\Listing\Columns\Column
{
    protected $storeManager;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        StoreManagerInterface $storeManager,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->storeManager = $storeManager;
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if(isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            $path = $this->storeManager->getStore()->getBaseUrl(
                        \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
                    );
            
            foreach ($dataSource['data']['items'] as & $item) {               
                $item[$fieldName . '_src'] = $path.'/label/image/'.$item['product_label_logo'];
                $item[$fieldName . '_alt'] = $item['label_name'];
                $item[$fieldName . '_orig_src'] = $path.'/label/image/'.$item['product_label_logo'];
            }
        }

        return $dataSource;
    }   
}