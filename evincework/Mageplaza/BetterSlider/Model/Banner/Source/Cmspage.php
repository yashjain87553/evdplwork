<?php

namespace Mageplaza\BetterSlider\Model\Banner\Source;

class Cmspage  extends \Magento\Framework\View\Element\Template implements \Magento\Framework\Option\ArrayInterface
{   
    protected $_storeManager;
    public function __construct(
    \Magento\Backend\Block\Template\Context $context,
    \Magento\Cms\Model\PageFactory $pageFactory,
    \Magento\Store\Model\StoreManagerInterface $storeManager,        
    array $data = []
                               )
{
    $this->pageFactory = $pageFactory;        
    $this->_storeManager = $storeManager;        
    parent::__construct($context, $data);
}
    public function toOptionArray()
    {
        $this->getStoreId(); 
        $page = $this->pageFactory->create();
        $x = array();
        $i=0;
        foreach($page->getCollection() as $item)
        {
            $x[$i]['value'] = $item->getId();
            $x[$i]['label'] = $item->getTitle();
            $i++;
        }
        return $x;
    }
}
