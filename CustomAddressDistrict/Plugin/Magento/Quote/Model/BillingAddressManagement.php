<?php

namespace Fingent\CustomAddressDistrict\Plugin\Magento\Quote\Model;

use Magento\Quote\Model\BillingAddressManagement as MagentoBillingAddressManagement;
use Magento\Quote\Api\Data\AddressInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BillingAddressManagement
 *
 * @package Fingent\CustomAddressDistrict
 */
class BillingAddressManagement
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * BillingAddressManagement constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    /**
     * Before Assign
     *
     * @param MagentoBillingAddressManagement $subject
     * @param $cartId
     * @param AddressInterface $address
     * @param bool $useForShipping
     */
    public function beforeAssign(
        MagentoBillingAddressManagement $subject,
        $cartId,
        AddressInterface $address,
        $useForShipping = false
    ) {
        $extAttributes = $address->getExtensionAttributes();
        if (!empty($extAttributes)) {
            try {
                $address->setDistrict($extAttributes->getDistrict());
            } catch (\Exception $e) {
                $this->logger->critical($e->getMessage());
            }
        }
    }
}
