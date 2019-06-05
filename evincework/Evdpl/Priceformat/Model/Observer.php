<?php
namespace Eharvest\Module\Model;
class Observer
{
    protected $_scredirectData;
    protected $_registry = null;

    public function __construct (
        \Eharvest\ScRedirect\Helper\Data $scredirectData,
        \Magento\Framework\Registry $registry
    ) {
        $this->_scredirectData = $scredirectData;
        $this->_registry = $registry;
    }

}