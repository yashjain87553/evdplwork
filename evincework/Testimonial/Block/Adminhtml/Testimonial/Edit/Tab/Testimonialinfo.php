<?php
namespace Evdpl\Testimonial\Block\Adminhtml\Testimonial\Edit\Tab;

class Testimonialinfo extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    
    protected $typeOptions;

   
    protected $statusOptions;

    public function __construct(
        \Evdpl\Testimonial\Model\Source\Status $statusOptions,
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        array $data = []
    )
    {
        $this->statusOptions = $statusOptions;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {   

        $monial = $this->_coreRegistry->registry('evdpl_testimonial');
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('testimonial_');
        $form->setFieldNameSuffix('testimonial');
        $fieldset = $form->addFieldset(
            'base_fieldset',
            [
                'legend' => __('Testimonial Information'),
                'class'  => 'fieldset-wide'
            ]
        );
        $fieldset->addType('image', 'Evdpl\Testimonial\Block\Adminhtml\Testimonial\Helper\Image');
        if ($monial->getId()) {
            $fieldset->addField(
                'testimonial_id',
                'hidden',
                ['name' => 'testimonial_id']
            );
        }
        $fieldset->addField(
            'author_name',
            'text',
            [
                'name'  => 'author_name',
                'label' => __('Name'),
                'title' => __('Name'),
                'required' => true,
            ]
        );
        $fieldset->addField(
            'author_image',
            'image',
            [
                'name'  => 'author_image',
                'label' => __(' Author Image'),
                'title' => __(' Author Image'),
            ]
        );
        $fieldset->addField(
            'message',
            'text',
            [
                'name'  => 'message',
                'label' => __('Message'),
                'title' => __('Message'),
                'required' => true,
            ]
        );
        $fieldset->addField(
        'testimonial_date',
        'date',
        [
            'name' => 'testimonial_date',
            'label' => __('Testmonial Date'),
            'title' => __('Date'),
            'required' => true,
            'date_format' => 'yyyy-MM-dd',
            
        ]
);     
        $fieldset->addField(
            'display_order',
            'text',
            [
                'name'  => 'display_order',
                'label' => __(' Display Order'),
                'title' => __('Display Order'),
                'required' => true,
            ]
        );
         $fieldset->addField(
            'rating',
            'select',
            [
               'name'  => 'rating',
               'label' => __('Select Rating'),
               'title' => __('Select Rating'),
               'required' => true,
               'options' => $this->statusOptions->getratingOptionArray(),
           ]
        );
       
        $fieldset->addField(
            'status',
            'select',
            [
                'name'  => 'status',
                'label' => __('Status'),
                'title' => __('Status'),
                'values' => $this->statusOptions->toOptionArray(),
            ]
        );
     
        $monialData = $this->_session->getData('evdpl_testimonial_testimonial_data', true);
        if ($monialData) {
            $monial->addData($monialData);
        } /*else {
            if (!$label->getId()) {
                $label->addData($label->getDefaultValues());
            }
        }*/
    
        $form->addValues($monial->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }

    
    public function getTabLabel()
    {
        return __('Testimonial');
    }

  
    public function getTabTitle()
    {
        return $this->getTabLabel();
    }

  
    public function canShowTab()
    {
        return true;
    }

   
    public function isHidden()
    {
        return false;
    }
}