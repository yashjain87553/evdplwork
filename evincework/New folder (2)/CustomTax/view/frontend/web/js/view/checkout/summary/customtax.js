define(
   [
       'jquery',
       'Magento_Checkout/js/view/summary/abstract-total'
   ],
   function ($,Component) {
       "use strict";
       return Component.extend({
           defaults: {
               template: 'Evdpl_CustomTax/checkout/summary/customtax'
           },
           isDisplayedCustomtax : function(){
            var customData = window.checkoutConfig.myCustomData;
            if(customData==0){
               return true;
             }
             else {
              return true;
             }
           },
           getCustomTax : function(){
            var customData = window.checkoutConfig.myCustomData;
               return customData;
           }
       });
   }
);