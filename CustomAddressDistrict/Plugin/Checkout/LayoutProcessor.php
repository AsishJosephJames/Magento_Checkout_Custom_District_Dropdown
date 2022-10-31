<?php

namespace Fingent\CustomAddressDistrict\Plugin\Checkout;

use Magento\Checkout\Block\Checkout\LayoutProcessor as LayoutProcessorAlias;
use Fingent\CustomAddressDistrict\Model\ResourceModel\District\CollectionFactory;

class LayoutProcessor
{
    protected $districtOption;

    /**
     * LayoutProcessor constructor.
     * @param DirectoryHelper $directoryHelper
     * @param \Vendor\Module\Model\Stateoptions $stateOptions
     */
    public function __construct(
        \Fingent\CustomAddressDistrict\Model\Address\Attribute\Source\District $districtOption
    ) {

        $this->districtOption = $districtOption;
    }


    /**
     * @param LayoutProcessorAlias $subject
     * @param array $jsLayout
     * @return array
     */
    public function afterProcess(
        LayoutProcessorAlias $subject,
        array $jsLayout
    ) {
        $customAttributeCode = 'district';
        //Set District field in the Shipping step.
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']
        ['children']['shippingAddress']['children']['shipping-address-fieldset']['children'][$customAttributeCode]
            = $this->getField($customAttributeCode, 'shippingAddress.custom_attributes');

        //Set District field in the billing step.
        if (isset($jsLayout['components']['checkout']['children']['steps']['children']
            ['billing-step']['children']['payment']['children']
            ['payments-list'])) {
            $paymentForms = $jsLayout['components']['checkout']['children']['steps']['children']
            ['billing-step']['children']['payment']['children']
            ['payments-list']['children'];

            foreach ($paymentForms as $paymentMethodForm => $paymentMethodValue) {
                $paymentMethodCode = str_replace('-form', '', $paymentMethodForm);

                if (!isset($jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children'][$paymentMethodCode . '-form'])) {
                    continue;
                }

                $jsLayout['components']['checkout']['children']['steps']['children']
                ['billing-step']['children']['payment']['children']
                ['payments-list']['children'][$paymentMethodCode . '-form']['children']['form-fields']['children'][$customAttributeCode]
                    = $this->getField($customAttributeCode, 'billingAddress' . $paymentMethodCode . '.custom_attributes');
            }
        }
        return $jsLayout;
    }

    public function getField($attributeCode, $scope)
    {
        $region = $this->districtOption->getAllOptions();
        
        return [
            'component' => 'Magento_Ui/js/form/element/select',
            'config' => [
                // customScope is used to group elements within a single form (e.g. they can be validated separately)
                'customScope' => $scope,
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/select',
                'id' => 'district',
                'tooltip' => [
                    'description' => 'Select District',
                ],
            ],
            'dataScope' => $scope . '.' . $attributeCode,
            'label' => 'District',
            'provider' => 'checkoutProvider',
            'sortOrder' => 100,
            'validation' => [
            ],
            'id' => 'district',
            'options' => $region,
            'filterBy' => null,
            'customEntry' => null,
            'visible' => true,
        ];
    }
}
