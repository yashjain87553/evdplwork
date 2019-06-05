<?php

namespace Evdpl\Testimonial\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Contact Resource Model
 *
 * @author      Pierre FAY
 */
class Monial extends AbstractDb
{
	 const TBL_ATT_PRODUCT = 'evdpl_testimonial';
    /**
     * Initialize resource
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('evdpl_testimonial', 'testimonial_id');
    }
}