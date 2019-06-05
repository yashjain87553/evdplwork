define(
    [
        'Evdpl_CustomTax/js/view/checkout/summary/customtax'
    ],
    function (Component) {
        'use strict';
        return Component.extend({
 
            /**
             * @override
             */
            isDisplayed: function () {
                return true;
            }
        });
    }
);