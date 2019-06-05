<?php
namespace Evdpl\Productlabel\Block\Adminhtml\Label;

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
        $this->_objectId = 'label_id';
        $this->_blockGroup = 'Evdpl_Productlabel';
        $this->_controller = 'adminhtml_label';
        parent::_construct();
        $this->buttonList->update('save', 'label', __('Save Label'));
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
        $this->buttonList->update('delete', 'label', __('Delete Label'));
    }
    
    public function getHeaderText()
    {
    	
      
        $label = $this->coreRegistry->registry('product_label_table');
        if ($label->getId()) {
            return __("Edit Label '%1'", $this->escapeHtml($label->getLabelName()));
        }
        return __('New Label');
    }
}