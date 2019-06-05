<?php
namespace Evdpl\Testimonial\Controller\Adminhtml\Testimonial;

class Delete extends \Evdpl\Testimonial\Controller\Adminhtml\Testimonial
{
    /**
     * execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('testimonial_id');
        if ($id) {
            $name = "";
            try {
                
                $monial = $this->monialFactory->create();
                $monial->load($id);
                $name = $monial->getName();
                $monial->delete();
                $this->messageManager->addSuccess(__('The Testimonial has been deleted.'));
                $this->_eventManager->dispatch(
                    'adminhtml_evdpl_testimonial_testimonial_on_delete',
                    ['name' => $name, 'status' => 'success']
                );
                $resultRedirect->setPath('*/*/');
                return $resultRedirect;
            } catch (\Exception $e) {
                $this->_eventManager->dispatch(
                    'adminhtml_evdpl_testimonial_testimonial_on_delete',
                    ['name' => $name, 'status' => 'fail']
                );
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                $resultRedirect->setPath('evdpl_testimonial/*/edit', ['testimonial_id' => $id]);
                return $resultRedirect;
            }
        }
        // display error message
        $this->messageManager->addError(__('testimonial to delete was not found.'));
        // go to grid
        $resultRedirect->setPath('evdpl_testimonial/*/');
        return $resultRedirect;
    }
}