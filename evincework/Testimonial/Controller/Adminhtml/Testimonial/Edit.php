<?php

namespace Evdpl\Testimonial\Controller\Adminhtml\Testimonial;

class Edit extends \Evdpl\Testimonial\Controller\Adminhtml\Testimonial{

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
        \Evdpl\Testimonial\Model\MonialFactory $monialFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($monialFactory, $registry, $context);
    }

    /**
     * is action allowed
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Evdpl_Testimonial::Testimonial');
    }

    public function execute()
    {    
         $id = $this->getRequest()->getParam('evdpl_testimonial');
        
        $monial = $this->initBanner();
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Testimonial'));
        if ($id) {
            $monial->load($id);
            if (!$monial->getId()) {
                $this->messageManager->addError(__('This testimonial no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                $resultRedirect->setPath(
                    'Evdpl_Testimonial/*/edit',
                    [
                        'testimonial_id' => $monial->getId(),
                        '_current' => true
                    ]
                );
                return $resultRedirect;
            }
        }
        $title = $monial->getId() ? $monial->getAuthorName() : __('New Testimonial');
        $resultPage->getConfig()->getTitle()->prepend($title);
        $data = $this->_session->getData('evdpl_testimonial_testimonial_data', true);
        
        if (!empty($data)) {
        
            $monial->setData($data);

        }
        return $resultPage;
    }
    }
