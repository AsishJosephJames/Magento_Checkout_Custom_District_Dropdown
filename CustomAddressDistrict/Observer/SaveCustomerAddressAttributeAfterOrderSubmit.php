<?php


namespace Fingent\CustomAddressDistrict\Observer;

use Magento\Customer\Api\AddressRepositoryInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\LocalizedException;
use Fingent\CustomAddressDistrict\Helper\Config as FingentConfig;

/**
 * Class SaveCustomerAddressAttributeAfterOrderSubmit
 *
 * @package Fingent\CustomAddressDistrict
 */
class SaveCustomerAddressAttributeAfterOrderSubmit implements ObserverInterface
{
    /**
     * @var AddressRepositoryInterface
     */
    protected $addressRepository;

    /**
     * SaveCustomerAddressAttributeAfterOrderSubmit constructor.
     * @param AddressRepositoryInterface $addressRepository
     */
    public function __construct(AddressRepositoryInterface $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    /**
     * The event used to save the custom field value in custom attribute after order submit
     *
     * @param Observer $observer
     * @return $this
     */
    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        if($order->getShippingAddress()) {
            try {
                $customerShippingAddressId = $order->getShippingAddress()->getCustomerAddressId();

                if ($customerShippingAddressId) {
                    $district = $order->getShippingAddress()->getDistrict();
                    $address = $this->addressRepository->getById($customerShippingAddressId);
                    $address->setCustomAttribute(FingentConfig::DISTRICT_ATTRIBUTE, $district);
                    $this->addressRepository->save($address);
                }
            } catch (LocalizedException $e) {
                return $this;
            }
        }
        if($order->getBillingAddress()){
            try {
                $customerBillingAddressAddressId = $order->getBillingAddress()->getCustomerAddressId();
                if ($customerBillingAddressAddressId) {
                    $district = $order->getBillingAddress()->getDistrict();

                    $address = $this->addressRepository->getById($customerBillingAddressAddressId);
                    $address->setCustomAttribute(FingentConfig::DISTRICT_ATTRIBUTE, $district);
                    $this->addressRepository->save($address);
                }
            } catch (LocalizedException $e) {
                return $this;
            }
        }

        return $this;
    }
}
