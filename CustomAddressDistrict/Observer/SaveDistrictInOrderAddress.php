<?php

namespace Fingent\CustomAddressDistrict\Observer;

use Exception;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Quote\Model\Quote;
use Magento\Sales\Model\Order;

/**
 * Class SaveDistrictInOrderAddress
 *
 * @package Fingent\CustomAddressDistrict
 */
class SaveDistrictInOrderAddress implements ObserverInterface
{
    /**
     * The event used to save the quote billing address and shipping address in sales_order_address table
     *
     * @param Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $quote = $observer->getEvent()->getQuote();
        if ($quote->getBillingAddress()) {
            $order->getBillingAddress()->setDistrict($quote->getBillingAddress()->getExtensionAttributes()->getDistrict());
        }
        if (!$quote->isVirtual()) {
            $order->getShippingAddress()->setDistrict($quote->getShippingAddress()->getDistrict());
        }
        return $this;
    }
}
