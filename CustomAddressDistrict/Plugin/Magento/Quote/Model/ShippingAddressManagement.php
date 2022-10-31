<?php

namespace Fingent\CustomAddressDistrict\Plugin\Magento\Quote\Model;

use Magento\Quote\Model\ShippingAddressManagement as MagentoShippingAddressManagement;
use Magento\Quote\Api\Data\AddressInterface;

/**
 * Class ShippingAddressManagement
 *
 * @package Fingent\CustomAddressDistrict
 */
class ShippingAddressManagement
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * ShippingAddressManagement constructor.
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    /**
     * Before Assign
     *
     * @param MagentoShippingAddressManagement $subject
     * @param $cartId
     * @param AddressInterface $address
     */
    public function beforeAssign(
        MagentoShippingAddressManagement $subject,
        $cartId,
        AddressInterface $address
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
