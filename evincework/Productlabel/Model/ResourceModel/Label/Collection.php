<?php

namespace Evdpl\Productlabel\Model\ResourceModel\Label;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
  
    public function _construct()
    {
        $this->_init('Evdpl\Productlabel\Model\Label', 'Evdpl\Productlabel\Model\ResourceModel\Label');
    }
}
