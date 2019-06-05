<?php

namespace Evdpl\Testimonial\Controller\Adminhtml\Testimonial;
class InlineEdit extends \Magento\Backend\App\Action
{
    /**
     * JSON Factory
     * 
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $jsonFactory;

    
    protected $monialFactory;

    public function __construct(
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Evdpl\Testimonial\Model\MonialFactory $monialFactory,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->jsonFactory   = $jsonFactory;
        $this->monialFactory = $monialFactory;
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
        foreach (array_keys($postItems) as $testimonialId) {
        
           
            $monial = $this->monialFactory->create()->load($testimonialId);
            try {
                $monialData = $postItems[$testimonialId];
                $monial->addData($monialData);
                $monial->save();
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $messages[] = $this->getErrorWithTestimonialId($monial, $e->getMessage());
                $error = true;
            } catch (\RuntimeException $e) {
                $messages[] = $this->getErrorWithTestimonialId($monial, $e->getMessage());
                $error = true;
            } catch (\Exception $e) {
                $messages[] = $this->getErrorWithTestimonialId(
                    $monial,
                    __('Something went wrong while saving the testimonial.')
                );
                $error = true;
            }
        }
        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

 
    protected function getErrorWithTestimonialId(\Evdpl\Testimonial\Model\Monial $monial, $errorText)
    {
        return '[Testimonial ID: ' . $monial->getId() . '] ' . $errorText;
    }
    }