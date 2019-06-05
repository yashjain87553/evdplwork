<?php
namespace Evdpl\Productlabel\Controller\Adminhtml;

abstract class Label extends \Magento\Backend\App\Action
{
   
    protected $labelFactory;

    
    protected $coreRegistry;


    public function __construct(
        \Evdpl\Productlabel\Model\LabelFactory $labelFactory,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->labelFactory         = $labelFactory;
        $this->coreRegistry          = $coreRegistry;
        parent::__construct($context);
    }

   
    protected function initBanner()
    {
        $labelId  = (int) $this->getRequest()->getParam('label_id');
        
        $label    = $this->labelFactory->create();
        if ($labelId) {
            $label->load($labelId);
        }
        $this->coreRegistry->register('product_label_table', $label);
        return $label;
    }
}