<?php
namespace Evdpl\Productlabel\Block\Adminhtml\Label\Edit;

/**
 * @method Tabs setTitle(\string $title)
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * constructor
     *
     * @return void
   */
  protected function _construct()
    {
        parent::_construct();
        $this->setId('label_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Label Information'));
    }
}