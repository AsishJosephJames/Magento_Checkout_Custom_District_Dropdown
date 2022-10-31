<?php
namespace Fingent\CustomAddressDistrict\Plugin\Magento\Quote\Model\Quote\Address;

use Magento\Quote\Model\Quote\Address\BillingAddressPersister as MagentoBillingAddressPersister;
use Magento\Quote\Api\Data\AddressInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BillingAddressPersister
 * @package Fingent\CustomAddressDistrict\Plugin\Magento\Quote\Model\Quote\Address
 */
class BillingAddressPersister
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * BillingAddressPersister constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    /**
     * Before Save
     *
     * @param MagentoBillingAddressPersister $subject
     * @param $quote
     * @param AddressInterface $address
     * @param bool $useForShipping
     */
    public function beforeSave(
        MagentoBillingAddressPersister $subject,
        $quote,
        AddressInterface $address,
        bool $useForShipping = false
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
