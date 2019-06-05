<?php
/**
 *
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Evdpl\Orderreport\Controller\Adminhtml\Report\Product;

class Grid extends \Magento\Reports\Controller\Adminhtml\Report\Product
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
        
         $this->_view->loadLayout(false);
        $this->_view->renderLayout();
    }
}
