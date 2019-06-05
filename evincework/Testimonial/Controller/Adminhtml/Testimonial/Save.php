<?php

namespace Evdpl\Testimonial\Controller\Adminhtml\Testimonial;

class Save extends \Evdpl\Testimonial\Controller\Adminhtml\Testimonial
{
    
    protected $uploadModel;

    
    protected $imageModel;

    protected $jsHelper;

    
    public function __construct(
         \Evdpl\Testimonial\Model\Upload $uploadModel,
        \Evdpl\Testimonial\Model\Source\Image $imageModel,
        \Magento\Backend\Helper\Js $jsHelper,
        \Evdpl\Testimonial\Model\MonialFactory $monialFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->uploadModel    = $uploadModel;
        $this->imageModel     = $imageModel;
        $this->jsHelper       = $jsHelper;
        parent::__construct($monialFactory, $registry, $context);
    }

    public function execute()
    {   

        
        $data = $this->getRequest()->getPost('testimonial');
        /*print_r($data['rating']);
        echo "<br>";
        print_r($data);
        exit;*/
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $monial = $this->initBanner();
            $monial->setData($data);

           
            $imageFile = $this->uploadModel->uploadFileAndGetName('author_image', $this->imageModel->getBaseDir(), $data);
         
            $monial->setAuthorImage($imageFile);
            try {
                $monial->save();
                $this->messageManager->addSuccess(__('The testimonial has been saved.'));
                if ($this->getRequest()->getParam('back')) {
                 return $resultRedirect->setPath('*/*/edit', ['testimonial_id' => $monial->getId(), '_current' => true]);
                   
                }
               return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the Testimonial.'));
            }
            $this->_getSession()->setEvdplTestimonialTestiminialData($data);
           return $resultRedirect->setPath('*/*/edit', ['testimonial_id' => $this->getRequest()->getParam('testimonial_id')]);
        }
       return $resultRedirect->setPath('*/*/');
    }
}