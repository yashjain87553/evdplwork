<?php
namespace Evdpl\Productlabel\Controller\Adminhtml\Label;

class Delete extends \Evdpl\Productlabel\Controller\Adminhtml\label
{
    /**
     * execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('label_id');
        if ($id) {
            $name = "";
            try {
                
                $label = $this->labelFactory->create();
                $label->load($id);
                $name = $label->getName();
                $label->delete();
                $this->messageManager->addSuccess(__('The label has been deleted.'));
                $this->_eventManager->dispatch(
                    'adminhtml_evdpl_productlabel_label_on_delete',
                    ['name' => $name, 'status' => 'success']
                );
                $resultRedirect->setPath('*/*/');
                return $resultRedirect;
            } catch (\Exception $e) {
                $this->_eventManager->dispatch(
                    'adminhtml_evdpl_productlabel_label_on_delete',
                    ['name' => $name, 'status' => 'fail']
                );
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                $resultRedirect->setPath('evdpl_productlabel/*/edit', ['label_id' => $id]);
                return $resultRedirect;
            }
        }
        // display error message
        $this->messageManager->addError(__('label to delete was not found.'));
        // go to grid
        $resultRedirect->setPath('evdpl_productlabel/*/');
        return $resultRedirect;
    }
}