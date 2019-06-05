<?php

namespace Evdpl\Testimonial\Model\ResourceModel\Monial;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
  
    public function _construct()
    {
        $this->_init('Evdpl\Testimonial\Model\Monial', 'Evdpl\Testimonial\Model\ResourceModel\Monial');
    }
}