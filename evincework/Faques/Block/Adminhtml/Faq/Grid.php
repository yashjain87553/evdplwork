<?php
namespace Evince\Faques\Block\Adminhtml\Faq;


use Evince\Faques\Model\Status;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @var \Evince\Faques\Model\QuestionFactory
     */
    protected $_questionFactory;

    /**
     * @var \SR\Weblog\Model\Status
     */
    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Evince\Faques\Model\QuestionFactory $questionFactory
     * @param \Evince\Faques\Model\Status $status
     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param array $data
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Evince\Faques\Model\QuestionFactory $questionFactory,
        \Evince\Faques\Model\Status $status,
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    ) {
        $this->_questionFactory = $questionFactory;
        $this->_status = $status;
        $this->moduleManager = $moduleManager;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('postGrid');
        $this->setDefaultSort('question_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
        $this->setFilterVisibility(false);
        //$this->setVarNameFilter('filter');
    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = $this->_questionFactory->create()->getCollection();

        $this->setCollection($collection);


        parent::_prepareCollection();
        return $this;
    }

    /**
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'question_id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'question_id',
                 'filter' => false,
                 'sortable'=> false,
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                'name'=>'question_id'
            ]
        );
        $this->addColumn(
            'question_title',
            [
                'header' => __('Question Title'),
                'index' => 'question_title',
                'class' => 'xxx',
                 'filter' => false,
                 'sortable'=> false,
                'name'=>'question_title'
            ]
        );

        $this->addColumn(
            'answer',
            [
                'header' => __('Answer'),
                'index' => 'answer',
                 'filter' => false,
                 'sortable'=> false,
                'class' => 'xxx',
                'name'=>'answer'
            ]
        );

       $this->addColumn(
            'question_type',
            [
               'header' => __('Question Type'),
               'index' => 'question_type',
               'filter' => false,
               'sortable'=> false,
               'class' => 'xxx',
                'name'=>'question_type'
           ]
        );



        $this->addColumn(
            'answer',
            [
                'header' => __('Answer'),
                'index' => 'answer',
                 'filter' => false,
                 'sortable'=> false,
                'class' => 'xxx',
                'name'=>'answer'
            ]
        );

        $this->addColumn(
            'publish_date',
            [
                'header' => __('Publish Date'),
                'index' => 'publish_date',
                 'filter' => false,
                 'sortable'=> false,
                'name'=>'publish_date'
            ]
        );


        $this->addColumn(
            'status',
            [
                'header' => __('Status'),
                 'filter' => false,
                 'sortable'=> false,
                'index' => 'status',
                'type' => 'options',
                'name'=>'status',
                'options' => $this->_status->getOptionArray()
            ]
        );


        $this->addColumn(
            'edit',
            [
                'header' => __('Edit'),
                'type' => 'action',
                'getter' => 'getId',
                'actions' => [
                    [
                        'caption' => __('Edit'),
                        'url' => [
                            'base' => '*/*/edit'
                        ],
                        'field' => 'question_id'
                    ]
                ],
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'header_css_class' => 'col-action',
                'column_css_class' => 'col-action'
            ]
        );

        $block = $this->getLayout()->getBlock('grid.bottom.links');
        if ($block) {
            $this->setChild('grid.bottom.links', $block);
        }

        return parent::_prepareColumns();
    }

    /**
     * @return $this
     */

    
    protected function _prepareMassaction()
    {
        
        $this->setMassactionIdField('question_id');
//    $this->getMassactionBlock()->setTemplate('Evince_Faques::faq/grid/massaction_extended.phtml');
        $this->getMassactionBlock()->setFormFieldName('question');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('faques/*/massDelete'),
                'confirm' => __('Are you sure?')
            ]
        );

        $statuses = $this->_status->getOptionArray();

        array_unshift($statuses, ['label' => '', 'value' => '']);
        $this->getMassactionBlock()->addItem(
            'status',
            [
                'label' => __('Change status'),
                'url' => $this->getUrl('faques/*/massStatus', ['_current' => true]),
                'additional' => [
                    'visibility' => [
                        'name' => 'status',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => __('Status'),
                        'values' => $statuses
                    ]
                ]
            ]
        );


        return $this;
    }

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('faques/*/grid', ['_current' => true]);
    }

    /**
     * @param \SR\Weblog\Model\BlogPosts|\Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl(
            'faques/*/edit',
            array('store' => $this->getRequest()->getParam('store'), 'question_id' => $row->getId())
        );
    }
    
}