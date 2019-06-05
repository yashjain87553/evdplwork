<?php
namespace Evdpl\Productlabel\Block\Adminhtml\Label\Edit\Tab;

class categorylabel extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
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
            'category_label_logo',
            'image',
            [
                'name'  => 'category_label_logo',
                'label' => __('Upload Category Label Logo'),
                'title' => __('Upload Category Label Logo'),
            ]
        );
     $field = $fieldset->addField(
            'category_label_color',
            'text',
            [
                'name'  => 'category_label_color',
                'label' => __('Category Label Color'),
                'title' => __('Category Label Color'),
                'required' => true,
            ]
        );
      
        $fieldset->addField(
            'category_label_text',
            'text',
            [
                'name'  => 'category_label_text',
                'label' => __('Category Label Text'),
                'title' => __('Category Label Text'),
                'required' => true,
            ]
        );
         $fieldset->addField(
            'category_label_position',
            'radios',
            [
                'label' => __('Label Position'),
                'title' => __('Label Position'),
                'name' => 'category_label_position',
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
        return __('Category Label');
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