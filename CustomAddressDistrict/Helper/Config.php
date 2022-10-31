<?php

namespace Fingent\CustomAddressDistrict\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Config
 * @package Fingent\CustomAddressDistrict\Helper
 */
class Config extends AbstractHelper
{
    /**
     * XML config path for address labels
     */
    const XPATH_CUSTOMER_ADDRESS_LABELS = "customer_address_section/address_labels/labels";

    const DISTRICT_ATTRIBUTE = "district";

    const DELIVERY_CITY = "delivery_city";
    const DELIVERY_DISTRICT = "delivery_district";
    const DELIVERY_POSTCODE = "delivery_postcode";

    /**
     * @var Json
     */
    protected $jsonEncode;

    /**
     * Config constructor.
     * @param Context $context
     * @param Json $jsonEncode
     */
    public function __construct(
        Context $context,
        Json $jsonEncode
    ) {
        parent::__construct($context);

        $this->jsonEncode = $jsonEncode;
    }

    /**
     * Get Config value
     *
     * @param string $field
     * @param int|null $storeId
     *
     * @return mixed
     */
    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $field,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Get Address Label Options
     *
     * @return array
     */
    public function getAddressLabelOptions(): array
    {
        $serializedLabels = $this->getConfigValue(self::XPATH_CUSTOMER_ADDRESS_LABELS);
        $addressLabelArray = $this->unserializeLabels($serializedLabels);
        $addressLabelOptions = [];
        if ($addressLabelArray) {
            foreach ($addressLabelArray as $label) {
                $addressLabelOptions[] = ['label' => $label, 'value' => $label];
            }
        }
        return $addressLabelOptions;
    }

    /**
     * Unserialize Address labels
     *
     * @param string $serializedLabels
     *
     * @return array $addressLabelArray
     */
    private function unserializeLabels($serializedLabels)
    {
        try {
            $addressLabelUnserializedArray = $this->jsonEncode->unserialize($serializedLabels);
            $addressLabelArray = [];
            if (!empty($addressLabelUnserializedArray)) {
                $addressLabelArray = array_column($addressLabelUnserializedArray, 'addresslabel');
            }
        } catch (\Exception $exception) {
            $addressLabelArray = [];
        }

        return $addressLabelArray;
    }
}
