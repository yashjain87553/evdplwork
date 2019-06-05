<?php
namespace Evdpl\Testimonial\Block\Adminhtml\Testimonial;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
   
    protected $coreRegistry;

    /**
     * constructor
     * 
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Backend\Block\Widget\Context $context,
        array $data = []
    )
    {
        $this->coreRegistry = $coreRegistry;
        parent::__construct($context, $data);
    }

   
    protected function _construct()
    {
        $this->_objectId = 'testimonial_id';
        $this->_blockGroup = 'Evdpl_Testimonial';
        $this->_controller = 'adminhtml_testimonial';
        parent::_construct();
        $this->buttonList->update('save', 'label', __('Save Testimonial'));
        $this->buttonList->add(
            'save-and-continue',
            [
                'label' => __('Save and Continue Edit'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => [
                        'button' => [
                            'event' => 'saveAndContinueEdit',
                            'target' => '#edit_form'
                        ]
                    ]
                ]
            ],
            -100
        );
        $this->buttonList->update('delete', 'label', __('Delete Testimonial'));
    }
    
    public function getHeaderText()
    {
    	
      
        $monial = $this->coreRegistry->registry('evdpl_testimonial');
        if ($monial->getId()) {
            return __("Edit Testimonial '%1'", $this->escapeHtml($monial->getAuthorName()));
        }
        return __('New Testimonial');
    }
}