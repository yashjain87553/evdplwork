<?php


namespace Evdpl\Orderreport\Controller\Adminhtml\Report\Product;

class Sold extends \Magento\Reports\Controller\Adminhtml\Report\Product
{
	
    
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Evdpl_Orderreport::sold';

    /**
     * Sold Products Report Action
     *
     * @return void
     */
    public function execute()
    {
        $this->_initAction()->_setActiveMenu(
            'Magento_Reports::report_products_sold'
        )->_addBreadcrumb(
            __('Products Ordered'),
            __('Products Ordered')
        );
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Ordered Products Report'));
        $this->_view->renderLayout();
    }
}
