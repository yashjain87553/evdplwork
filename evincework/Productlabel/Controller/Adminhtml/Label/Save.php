<?php

namespace Evdpl\Productlabel\Controller\Adminhtml\Label;

class Save extends \Evdpl\Productlabel\Controller\Adminhtml\Label
{
    
    protected $uploadModel;

    
    protected $imageModel;

    protected $jsHelper;

    
    public function __construct(
         \Evdpl\Productlabel\Model\Upload $uploadModel,
        \Evdpl\Productlabel\Model\Source\Image $imageModel,
        \Magento\Backend\Helper\Js $jsHelper,
        \Evdpl\Productlabel\Model\LabelFactory $labelFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->uploadModel    = $uploadModel;
        $this->imageModel     = $imageModel;
        $this->jsHelper       = $jsHelper;
        parent::__construct($labelFactory, $registry, $context);
    }

    public function execute()
    {   
        $flag=0;
        $data = $this->getRequest()->getPost('label');
         $dataproducts = $this->getRequest()->getPost();
         $products=$dataproducts['products'];
         if($products){
         $newproducts=str_replace("&", ",",$products);
         $flag=1;
         }
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $label = $this->initBanner();
            $label->setData($data);

           
            $CategoryFile = $this->uploadModel->uploadFileAndGetName('category_label_logo', $this->imageModel->getBaseDir(), $data);
            $ProductFile = $this->uploadModel->uploadFileAndGetName('product_label_logo', $this->imageModel->getBaseDir(), $data);
          if($flag==1){
            $label->setProducts($newproducts.",");
        }
            $label->setCategoryLabelLogo($CategoryFile);
            $label->setProductLabelLogo($ProductFile);
            try {
                $label->save();
                $this->messageManager->addSuccess(__('The Label has been saved.'));
                if ($this->getRequest()->getParam('back')) {
                 return $resultRedirect->setPath('*/*/edit', ['label_id' => $label->getId(), '_current' => true]);
                   
                }
               return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the Banner.'));
            }
            $this->_getSession()->setEvdplProductlabelLabelData($data);
           return $resultRedirect->setPath('*/*/edit', ['label_id' => $this->getRequest()->getParam('label_id')]);
        }
       return $resultRedirect->setPath('*/*/');
    }
}