<?php

namespace Evdpl\Productlabel\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Contact Resource Model
 *
 * @author      Pierre FAY
 */
class Label extends AbstractDb
{
	 const TBL_ATT_PRODUCT = 'product_label_table';
    /**
     * Initialize resource
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('product_label_table', 'label_id');
    }
}