<?php
namespace Evdpl\Testimonial\Controller\Adminhtml;

abstract class Testimonial extends \Magento\Backend\App\Action
{
   
    protected $monialFactory;

    
    protected $coreRegistry;


    public function __construct(
        \Evdpl\Testimonial\Model\MonialFactory $monialFactory,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->monialFactory         = $monialFactory;
        $this->coreRegistry          = $coreRegistry;
        parent::__construct($context);
    }

   
    protected function initBanner()
    {
        $monialId  = (int) $this->getRequest()->getParam('testimonial_id');
        
        $monial    = $this->monialFactory->create();
        if ($monialId) {
            $monial->load($monialId);
        }
        $this->coreRegistry->register('evdpl_testimonial', $monial);
        return $monial;
    }
}