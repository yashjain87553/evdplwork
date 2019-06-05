<?php

/**
 * Landofcoder
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the Landofcoder.com license that is
 * available through the world-wide-web at this URL:
 * http://landofcoder.com/license
 * 
 * DISCLAIMER
 * 
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 * 
 * @category   Landofcoder
 * @package    Lof_FollowUpEmail
 * @copyright  Copyright (c) 2016 Landofcoder (http://www.landofcoder.com/)
 * @license    http://www.landofcoder.com/LICENSE-1.0.html
 */

namespace Evdpl\OrderedReview\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Stdlib\DateTime;
use Magento\Sales\Model\Order;
use Magento\Customer\Api\CustomerRepositoryInterface;

class OrderStatusChanged implements ObserverInterface {

    /**
     * @var \Magento\GoogleAdwords\Helper\Data
     */
    protected $_image;

    /**
     * @var \Magento\Sales\Model\ResourceModel\Order\Collection
     */
    protected $_collection;

    /**
     *
     * @var \Magento\Customer\Model\Session
     */
    protected $_customerSession;

    /**
     * @var \Magento\Framework\App\ResourceConnection 
     */
    protected $_resource;

    /**
     * @var \Magento\Quote\Model\QuoteFactory
     */
    protected $quoteFactory;

    /**
     * @var CustomerRepositoryInterface
     */
    protected $customerRepository;

    /**
     * @var cart
     */
    protected $cart;

    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $_session;

    /**
     * @var \Lof\FollowUpEmail\Model\Email $email
     */
    protected $email;

    /**
     * @var  \Lof\FollowUpEmail\Model\EmaillogFactory $emaillogFactory,
     */
    protected $emaillogFactory;

    /**
     * @var history
     */
    protected $history;

    /**
     * @var Validator
     */
    protected $validator;

    /**
     * @var emailFactory
     */
    protected $emailFactory;

    /**
     * @var helper
     */
    protected $helper;

    /**
     * @var blacklist
     */
    protected $blacklist;
    
    protected $_logger;

    /**
     * Constructor
     *
     * @param \Magento\GoogleAdwords\Helper\Data $image
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Sales\Model\ResourceModel\Order\Collection $collection
     */
    public function __construct(
    \Psr\Log\LoggerInterface $logger, \Magento\Framework\Registry $registry, \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $CollectionFactory, \Magento\Sales\Model\ResourceModel\Order\Collection $collection, \Magento\Framework\App\ResourceConnection $resource, CustomerRepositoryInterface $customerRepository, \Magento\Quote\Model\QuoteFactory $quoteFactory, \Magento\Checkout\Model\Cart $cart, \Magento\Checkout\Model\Session $session, \Magento\Customer\Model\Session $customerSession, \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->_logger = $logger;
        $this->_storeManager = $storeManager;
        $this->_collection = $collection;
        $this->_registry = $registry;
        $this->_customerSession = $customerSession;
        $this->_resource = $resource;
        $this->quoteFactory = $quoteFactory;
        $this->customerRepository = $customerRepository;
        $this->cart = $cart;
        $this->_session = $session;
    }

    /**
     * Set base grand total of order to registry
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return \Magento\GoogleAdwords\Observer\SetConversionValueObserver
     */
    public function execute(\Magento\Framework\Event\Observer $observer) {
        $order = $observer->getEvent()->getOrder();
        if ($order instanceof \Magento\Framework\Model\AbstractModel) {
            //if ($order->getState() == 'complete') {
                $this->_logger->addDebug('some text or variable');
            //}
        }
        $this->_logger->addDebug('some text or variable');
        return $this;
    }

    /**
     * Get store identifier
     *
     * @return  int
     */
    public function getStoreId() {
        return $this->_storeManager->getStore()->getId();
    }

}
