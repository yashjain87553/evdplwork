<?php

namespace Evince\Gift\Block;

class Gift extends \Magento\Framework\View\Element\Template {

    protected $_scopeConfig;

    public function __construct(
    \Magento\Framework\View\Element\Template\Context $context, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, array $data = []
    ) {


        $this->_scopeConfig = $scopeConfig;

        // $this->pageConfig->getTitle()->set(__('My Grid List'));
        parent::__construct($context, $data);
        //get collection of data 
    }

    public function getFee() {
        return $this->_scopeConfig->getValue('Extrafee/Extrafee/Extrafee_amount', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getGiftTxt() {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $cart = $objectManager->get('\Magento\Checkout\Model\Cart');

        // retrieve quote items collection
        $itemsCollection = $cart->getQuote()->getItemsCollection();
        $quoteid = $cart->getQuote()->getId();

        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();
        $tableName = $resource->getTableName('gift_message');
        $sql = "SELECT message FROM " . $tableName . " WHERE gift_message_id='" . $cart->getQuote()->getGiftMessageId() . "'";
        $result = $connection->fetchAll($sql);
        if (count($result) > 0) {
            if ($result[0]['message'] != "") {
                echo $result[0]['message'];
            } else {
                echo '';
            }
        }
    }

    public function getGiftSender() {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $cart = $objectManager->get('\Magento\Checkout\Model\Cart');

        // retrieve quote items collection
        $itemsCollection = $cart->getQuote()->getItemsCollection();
        $quoteid = $cart->getQuote()->getId();

        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();
        $tableName = $resource->getTableName('gift_message');
        $sql = "SELECT sender FROM " . $tableName . " WHERE gift_message_id='" . $cart->getQuote()->getGiftMessageId() . "'";
        $result = $connection->fetchAll($sql);
        if (count($result) > 0) {
            if ($result[0]['sender'] != "") {
                echo $result[0]['sender'];
            } else {
                echo '';
            }
        }
    }

    public function getGiftRecipient() {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $cart = $objectManager->get('\Magento\Checkout\Model\Cart');

        // retrieve quote items collection
        $itemsCollection = $cart->getQuote()->getItemsCollection();
        $quoteid = $cart->getQuote()->getId();

        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();
        $tableName = $resource->getTableName('gift_message');
        $sql = "SELECT recipient FROM " . $tableName . " WHERE gift_message_id='" . $cart->getQuote()->getGiftMessageId() . "'";
        $result = $connection->fetchAll($sql);
        if (count($result) > 0) {
            if ($result[0]['recipient'] != "") {
                echo $result[0]['recipient'];
            } else {
                echo '';
            }
        }
    }

}
