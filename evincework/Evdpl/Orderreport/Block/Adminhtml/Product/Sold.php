<?php

namespace Evdpl\Orderreport\Block\Adminhtml\Product;


class Sold extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Initialize container block settings
     *
     */
    public function __construct()
    {
       
        $this->_controller = 'adminhtml_report_product_sold';
        $this->_headerText = __('Products Ordered');
        parent::_construct();
        $this->buttonList->remove('add');
    }
}
