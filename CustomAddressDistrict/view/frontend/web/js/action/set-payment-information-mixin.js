
define([
    'jquery',
    'mage/utils/wrapper',
    'Magento_Checkout/js/model/quote'
], function ($, wrapper,quote) {
    'use strict';

    return function (setPaymentInformationAction) {

        return wrapper.wrap(setPaymentInformationAction, function (originalAction) {
            var billingAddress = quote.billingAddress();
            if (billingAddress && billingAddress.customAttributes) {
                billingAddress['extension_attributes'] = {};
                if(billingAddress.customAttributes.length > 0){
                    billingAddress.customAttributes.forEach((item) => {
                        if(item.attribute_code == "district"){
                            billingAddress['extension_attributes']['district'] = item.value;
                        }
                    });
                }else{
                    if(billingAddress.customAttributes['district'] !== undefined){
                        billingAddress['extension_attributes']['district'] = billingAddress.customAttributes['district']['value'];
                    }
                }

            }
            return originalAction();
        });
    };
});
