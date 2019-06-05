<?php

use Magento\Backend\App\Action;

class Grid extends Evince\Faques\Controller\Adminhtml\Faq
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $resultLayout = $this->resultLayoutFactory->create();
        return $resultLayout;
    }
}
