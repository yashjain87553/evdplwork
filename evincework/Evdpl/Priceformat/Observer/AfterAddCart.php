<?php
namespace Evdpl\Priceformat\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer as EventObserver;
use Magento\Checkout\Model\Cart as CustomerCart;

class AfterAddCart implements ObserverInterface
{
    /**
     * @var CustomerCart
     */
    private $cart;

    /**
     * @param CustomerCart $cart
     */
    public function __construct(
        CustomerCart $cart
    ){
        $this->cart = $cart;
    }

    public function execute(EventObserver $observer)
    {
        $this->cart->getQuote()->setHasError(true);
    }
}
?>