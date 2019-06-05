<?php

namespace Evdpl\Productlabel\Controller\Adminhtml\Label;

class Edit extends \Evdpl\Productlabel\Controller\Adminhtml\Label{

    /**
     * Page factory
     * 
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * Result JSON factory
     * 
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $resultJsonFactory;

    public function __construct(
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Evdpl\Productlabel\Model\LabelFactory $labelFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($labelFactory, $registry, $context);
    }

    /**
     * is action allowed
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Evdpl_Productlabel::Productlabel');
    }

    public function execute()
    {    
         $id = $this->getRequest()->getParam('label_id');
        
        $label = $this->initBanner();
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Label'));
        if ($id) {
            $label->load($id);
            if (!$label->getId()) {
                $this->messageManager->addError(__('This Label no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                $resultRedirect->setPath(
                    'Evdpl_Productlabel/*/edit',
                    [
                        'label_id' => $label->getId(),
                        '_current' => true
                    ]
                );
                return $resultRedirect;
            }
        }
        $title = $label->getId() ? $label->getLabelName() : __('New Label');
        $resultPage->getConfig()->getTitle()->prepend($title);
        $data = $this->_session->getData('evdpl_productlabel_label_data', true);
        
        if (!empty($data)) {
        
            $label->setData($data);

        }
        return $resultPage;
    }
    }
