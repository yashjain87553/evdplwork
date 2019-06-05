
define([
        'ko',
        'uiComponent',
        'Magento_Checkout/js/model/quote',
        'Magento_Catalog/js/price-utils'

    ], function (ko, Component, quote, priceUtils) {
        'use strict';
        var show_hide_customfee_blockConfig = window.checkoutConfig.show_hide_customfee_shipblock;
        var fee_label = window.checkoutConfig.fee_label;         
        var custom_fee_amount = window.checkoutConfig.custom_fee_amount;
        alert (show_hide_customfee_blockConfig);
        alert(fee_label);
        alert(custom_fee_amount);

        
        return Component.extend({
            defaults: {
                template: 'Evdpl_CustomFee/checkout/shipping/custom-fee'
            },
            alert(fee_label);
            canVisibleCustomFeeBlock: show_hide_customfee_blockConfig,
            getFormattedPrice: ko.observable(priceUtils.formatPrice(custom_fee_amount, quote.getPriceFormat())),
            getFeeLabel:ko.observable(fee_label)
        });
    });
