<?php
namespace Evdpl\Productlabel\Block\Adminhtml\Label\Edit\Tab;

use Evdpl\Productlabel\Model\LabelFactory;

class Products extends \Magento\Backend\Block\Widget\Grid\Extended
{
   
    protected $productCollectionFactory;

   
    protected $LabelFactory;

    
    protected $registry;

    protected $_objectManager = null;

    /**
     *
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Magento\Framework\Registry $registry
     * @param LabelFactory $attachmentFactory
     * @param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        LabelFactory $LabelFactory,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        array $data = []
    ) {
        $this->LabelFactory = $LabelFactory;
        $this->productCollectionFactory = $productCollectionFactory;
        $this->_objectManager = $objectManager;
        $this->registry = $registry;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * _construct
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('productsGrid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
        /*if ($this->getRequest()->getParam('label_id')) {
            $this->setDefaultFilter(array('in_product' => 1));
        }*/
    }

    protected function _addColumnFilterToCollection($column)
    {  
        if ($column->getId() == 'products') {
            $productIds = $this->_getSelectedProducts();

            if (empty($productIds)) {
                $productIds = 0;
            }
            if ($column->getFilter()->getValue()) {
                $this->getCollection()->addFieldToFilter('entity_id', array('in' => $productIds));
            } else {
                if ($productIds) {
                    $this->getCollection()->addFieldToFilter('entity_id', array('nin' => $productIds));
                }
            }


        } else {
            parent::_addColumnFilterToCollection($column);
        }

        return $this;
    }

    /**
     * prepare collection
     */
    protected function _prepareCollection()
    {
        $collection = $this->productCollectionFactory->create();
        $collection->addAttributeToSelect('name');
        $collection->addAttributeToSelect('sku');
        $collection->addAttributeToSelect('price');
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $model = $this->_objectManager->get('\Evdpl\Productlabel\Model\Label');

        $this->addColumn(
            'products',
            [
                'header_css_class' => 'a-center',
                'type' => 'checkbox',
                'name' => 'products',
                'align' => 'center',
                'index' => 'entity_id',
                'values' => $this->getSelectedProducts(),
            ]
        );

        $this->addColumn(
            'entity_id',
            [
                'header' => __('Product ID'),
                'type' => 'number',
                'index' => 'entity_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
            ]
        );
        $this->addColumn(
            'name',
            [
                'header' => __('Name'),
                'index' => 'name',
                'class' => 'xxx',
                'width' => '50px',
            ]
        );
        $this->addColumn(
            'sku',
            [
                'header' => __('Sku'),
                'index' => 'sku',
                'class' => 'xxx',
                'width' => '50px',
            ]
        );
        $this->addColumn(
            'price',
            [
                'header' => __('Price'),
                'type' => 'currency',
                'index' => 'price',
                'width' => '50px',
            ]
        );

        return parent::_prepareColumns();
    }

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/products', ['_current' => true]);
    }

    /**
     * @param  object $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return '';
    }

    protected function _getSelectedProducts()
    {
        $label = $this->getLabel();
        return $label->getProducts($label);
    }

    public function getSelectedProducts()
    {

        $label = $this->getLabel();
        if($label!=''){

        $selected = $label->getProducts($label);

        return $selected;
    }
    else {
        $selected=[];
        return $selected;
    }
    }

    protected function getLabel()
    {
        $labelId = $this->getRequest()->getParam('label_id');
        if($labelId!='')
        {

        $label   = $this->LabelFactory->create();
        if ($labelId) {
            $label->load($labelId);
        }
        return $label;
    }
    else {
        return ;
    }
    }

    
    public function canShowTab()
    {
        return true;
    }

    public function isHidden()
    {
        return true;
    }
}