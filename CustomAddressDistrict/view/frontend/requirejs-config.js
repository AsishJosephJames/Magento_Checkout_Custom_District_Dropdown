var config = {
    config: {
        mixins: {
            'Magento_Checkout/js/action/set-shipping-information': {
                'Fingent_CustomAddressDistrict/js/action/set-shipping-information-mixin': true
            },
            'Magento_Checkout/js/action/place-order': {
                'Fingent_CustomAddressDistrict/js/action/set-billing-address-mixin': true
            },
            ' Magento_Checkout/js/action/set-payment-information': {
                'Fingent_CustomAddressDistrict/js/action/set-payment-information-mixin': true
            }
        }
    }
};
