<?php

namespace Evdpl\Productlabel\Controller\Adminhtml\Label;
class InlineEdit extends \Magento\Backend\App\Action
{
    /**
     * JSON Factory
     * 
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $jsonFactory;

    
    protected $labelFactory;

    public function __construct(
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Evdpl\Productlabel\Model\LabelFactory $labelFactory,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->jsonFactory   = $jsonFactory;
        $this->labelFactory = $labelFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    { 
         $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];
        $postItems = $this->getRequest()->getParam('items', []);
        if (!($this->getRequest()->getParam('isAjax') && count($postItems))) {
            return $resultJson->setData([
                'messages' => [__('Please correct the data sent.')],
                'error' => true,
            ]);
        }
        foreach (array_keys($postItems) as $labelId) {
        
           
            $label = $this->labelFactory->create()->load($labelId);
            try {
                $labelData = $postItems[$labelId];
                $label->addData($labelData);
                $label->save();
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $messages[] = $this->getErrorWithlabelId($label, $e->getMessage());
                $error = true;
            } catch (\RuntimeException $e) {
                $messages[] = $this->getErrorWithlabelId($label, $e->getMessage());
                $error = true;
            } catch (\Exception $e) {
                $messages[] = $this->getErrorWithlabelId(
                    $label,
                    __('Something went wrong while saving the label.')
                );
                $error = true;
            }
        }
        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

 
    protected function getErrorWithlabelId(\Evdpl\Productlabel\Model\Label $label, $errorText)
    {
        return '[label ID: ' . $label->getId() . '] ' . $errorText;
    }
    }