<?php

namespace Evince\Gift\Controller\Index;

use Magento\Framework\App\Action\Context;

class Ajax extends \Magento\Framework\App\Action\Action {

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var \Magento\Framework\Json\Helper\Data
     */
    protected $jsonData;
    protected $layoutFactory;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory resultPageFactory
     */
    public function __construct(Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magento\Framework\Json\Helper\Data $jsonData, \Magento\Framework\View\LayoutFactory $layoutFactory) {
        $this->resultPageFactory = $resultPageFactory;

        $this->jsonData = $jsonData;
        $this->layoutFactory = $layoutFactory;
        parent::__construct($context);
    }

    public function execute() {
        $giftwrap = $this->getRequest()->getParam('giftwrap');
        $giftmessage = $this->getRequest()->getParam('giftmessage');
        $gift_from = $this->getRequest()->getParam('gift_from');
        $gift_to = $this->getRequest()->getParam('gift_to');
        $quote_id = $this->getRequest()->getParam('quote_id');
        $om = \Magento\Framework\App\ObjectManager::getInstance();

        $resource = $om->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();
        $tableName = $resource->getTableName('gift_message');

        $session = $om->get('Magento\Customer\Model\Session');
        $g_message = "SELECT entity_id,gift_message_id FROM " . $resource->getTableName('quote') . " WHERE gift_message_id!='' AND entity_id='" . $quote_id . "'";
        $result_g = $connection->fetchAll($g_message);
        if ($giftwrap == 1) {
            $session->setGiftEna(1);
            $session->setGiftKey('1');
            $session->setGiftMessage($giftmessage);
            $session->setGiftTo($gift_to);
            $session->setGiftFrom($gift_from);


            if (count($result_g) == 0) {
                $sql = "INSERT " . $tableName . " SET customer_id='0', sender='". $gift_from ."',recipient='". $gift_to ."', message='" . $giftmessage . "'";
                $connection->query($sql);
                $updateQuote = "UPDATE " . $resource->getTableName('quote') . " SET gift_message_id='" . $connection->lastInsertId() . "' WHERE entity_id='" . $quote_id . "'";
                $connection->query($updateQuote);
            } else {
                $sql = "UPDATE " . $tableName . " SET message='" . $giftmessage . "', sender='" . $gift_from . "', recipient='" . $gift_to . "' WHERE gift_message_id='" . $result_g[0]['gift_message_id'] . "'";
                $connection->query($sql);
            }

            echo true;
        } else {
            $session->setGiftEna(0);
            $session->setGiftKey('0');
            $session->setGiftMessage($giftmessage);
            $session->setGiftTo($gift_to);
            $session->setGiftFrom($gift_from);
            if ($result_g[0]['gift_message_id'] != "") {
                $sql = "UPDATE " . $tableName . " SET message='',sender='',recipient='' WHERE gift_message_id='" . $result_g[0]['gift_message_id'] . "'";
                $connection->query($sql);
            }
            echo false;
        }
        //echo $session->getGiftKey();
        exit;
    }

}
