define(
   [
       'jquery',
       'Magento_Checkout/js/view/summary/abstract-total'
   ],
   function ($,Component) {
       "use strict";
       return Component.extend({
           defaults: {
               template: 'Evdpl_Customtax/checkout/summary/customdiscount'
           },
           isDisplayedCustomdiscount : function(){
            var customData = window.checkoutConfig.myCustomData;
            if(customData==0){
               return false;
             }
             else {
              return true;
             }
           },
           getCustomDiscount : function(){
            var customData = window.checkoutConfig.myCustomData;
               return customData;
           }
       });
   }
);