<?php
namespace Evdpl\Productlabel\Block\Adminhtml\Label\Edit\Tab;

class labelinfo extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    
    protected $typeOptions;

   
    protected $statusOptions;

    public function __construct(
        \Evdpl\Productlabel\Model\Source\Status $statusOptions,
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

        $label = $this->_coreRegistry->registry('product_label_table');
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('label_');
        $form->setFieldNameSuffix('label');
        $fieldset = $form->addFieldset(
            'base_fieldset',
            [
                'legend' => __('Label Information'),
                'class'  => 'fieldset-wide'
            ]
        );
        $fieldset->addField(
            'label_name',
            'text',
            [
                'name'  => 'label_name',
                'label' => __('Name'),
                'title' => __('Name'),
                'required' => true,
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
     
        $labelData = $this->_session->getData('evdpl_productlabel_label_data', true);
        if ($labelData) {
            $label->addData($labelData);
        } /*else {
            if (!$label->getId()) {
                $label->addData($label->getDefaultValues());
            }
        }*/
    
        $form->addValues($label->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }

    
    public function getTabLabel()
    {
        return __('Label');
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