<?php
namespace Evdpl\Productlabel\Controller\Adminhtml\Label;

class MassDelete extends \Magento\Backend\App\Action
{
    protected $filter;

  
    protected $collectionFactory;

   
    public function __construct(
        \Magento\Ui\Component\MassAction\Filter $filter,
        \Evdpl\Productlabel\Model\ResourceModel\Label\CollectionFactory $collectionFactory,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->filter            = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }


  
    public function execute()
    {   
        $data = $this->getRequest()->getPost();
        if($data['excluded'] == 'false'){
        $collection = $this->collectionFactory->create();
        $delete = 0;
        foreach ($collection as $item) {
            $item->delete();
            $delete++;
        }
        } else{
            $ids = $data['selected'];
            $collection = $this->collectionFactory->create();
            $delete = 0;
            foreach ($collection as $item) {
                if(in_array($item->getLabelId(), $ids)){
                    $item->delete();
                    $delete++;
                }
            }
        }
        $this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', $delete));
        $resultRedirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}