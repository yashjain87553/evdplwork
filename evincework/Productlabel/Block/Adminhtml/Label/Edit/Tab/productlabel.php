<?php
namespace Evdpl\Productlabel\Block\Adminhtml\Label\Edit\Tab;

class productlabel extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
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
        $fieldset->addType('image', 'Evdpl\Productlabel\Block\Adminhtml\Label\Helper\Image');
        if ($label->getId()) {
            $fieldset->addField(
                'label_id',
                'hidden',
                ['name' => 'label_id']
            );
        }
       
        $fieldset->addField(
            'product_label_logo',
            'image',
            [
                'name'  => 'product_label_logo',
                'label' => __('Upload Product Label Logo'),
                'title' => __('Upload Product Label Logo'),
            ]
        );
        
     $field = $fieldset->addField(
            'product_label_color',
            'text',
            [
                'name'  => 'product_label_color',
                'label' => __('Label Color'),
                'title' => __('Label Color'),
                'required' => true,
            ]
        );
      
        $fieldset->addField(
            'product_label_text',
            'text',
            [
                'name'  => 'product_label_text',
                'label' => __('Product Label Text'),
                'title' => __('Product Label Text'),
                'required' => true,
            ]
        );
            $fieldset->addField(
            'product_label_position',
            'radios',
            [
                'label' => __('Label Position'),
                'title' => __('Label Position'),
                'name' => 'product_label_position',
                'required' => true,
                'values' => array(
                            array('value'=>'1','label'=>''),
                            array('value'=>'2','label'=>''),
                            array('value'=>'3','label'=>''),
                            array('value'=>'4','label'=>''),
                            array('value'=>'5','label'=>''),
                            array('value'=>'6','label'=>''),
                            array('value'=>'7','label'=>''),
                            array('value'=>'8','label'=>''),
                            array('value'=>'9','label'=>''),
                       ),
               'value' => '1'
            ]
        );
            $renderer = $this->getLayout()->createBlock('Evdpl\Productlabel\Block\Adminhtml\Label\Edit\Tab\Color');
         $field->setRenderer($renderer);
         
        $labelData = $this->_session->getData('evdpl_productlabel_label_data', true);
        if ($labelData) {
            $label->addData($labelData);
        } 
    
        $form->addValues($label->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }

    
    public function getTabLabel()
    {
        return __('Product Label');
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