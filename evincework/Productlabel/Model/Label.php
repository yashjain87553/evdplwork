<?php

namespace Evdpl\Productlabel\Model;

use Magento\Cron\Exception;
use Magento\Framework\Model\AbstractModel;

/**
 * Contact Model
 *
 * @author      Pierre FAY
 */
class Label extends AbstractModel
{
    /**
     * @var \Magento\Framework\Stdlib\DateTime
     */
    protected $_dateTime;

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Evdpl\Productlabel\Model\ResourceModel\Label');
    }
    public function getProducts(\Evdpl\Productlabel\Model\label $object)
    {

        $tbl = $this->getResource()->getTable(\Evdpl\Productlabel\Model\ResourceModel\Label::TBL_ATT_PRODUCT);
        $select = $this->getResource()->getConnection()->select()->from(
            $tbl,
            ['products']
        )
        ->where(
            'label_id = ?',
            (int)$object->getId()
        );
        $data=[];
        $data = $this->getResource()->getConnection()->fetchCol($select);
        $data = explode(',', $data[0]);
        return $data;
    }
}