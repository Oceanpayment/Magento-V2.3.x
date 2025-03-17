/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
/*browser:true*/
/*global define*/
define(
    [
        'jquery',
        'Magento_Checkout/js/view/payment/default',
        'Oceanpayment_Creditcardonepage/js/action/set-payment-method',
        'Magento_Checkout/js/model/payment/additional-validators'
    ],
    function ($, Component, setPaymentMethodAction) {
        'use strict';

        return Component.extend({
            defaults: {
                template: 'Oceanpayment_Creditcardonepage/payment/creditcardonepage'
            },
            
            getData:function(){
                var data = {
                    'method':this.item.method,
                    'additional_data':{
                        'card_data':$("#card_data").val()
                    }
                }
                return data;
            },
            
            getpaymenticon:function(){
                
                var paymentConfig = window.checkoutConfig.payment.creditcardonepage;
                var paymenticon_arr = paymentConfig.payment_icon.split(",");
                var img = '';
                paymenticon_arr.forEach(function(element) {
                    var imageUrl = require.toUrl('Oceanpayment_Creditcardonepage/images/'+element+'.png');
                    img = img+"<img src=\""+imageUrl+"\" width=\"60\">";
                });
                var div = document.getElementById("paymenticon");
                div.innerHTML = img;
            },
            
            opinput:function(){
                jQuery(function() {
                    // 获取后台配置数据
                    var paymentConfig = window.checkoutConfig.payment.creditcardonepage;
                    this.pay_mode = paymentConfig.pay_mode;
                    this.css_url = paymentConfig.css_url;
                    this.payment_language = paymentConfig.payment_language;
                    this.public_key = paymentConfig.public_key;
                    this.ssl = paymentConfig.ssl;
                    var domainName = this.ssl+window.location.hostname;
                    jQuery(function() {
                        //如需修改支付语言，可传入语言代码
                        onePageCardData.init(this.pay_mode,this.css_url,this.payment_language,this.public_key,domainName);
                    });
                    //如需修改支付语言，可传入语言代码
                    // onePageCardData.init('https://secure.oceanpayment.com/gateway/direct/pay',"","en","ba57a56ce38af606291eff3ac69f3d4e99a7c4f43ef136c6af9f076519dffc156f883647d5f0fac5acf6b02ed257849b8b7d5d780430ec16efe87a4239326bea0b7ba100e6f58e48376cf424a4f9e6ffa6d83f354f614071e7d6c862549b2ce2dbf6d96d805b27cbc8c504c094b197a10226ccaef77662097199b3b46da91179","https://goshop.xiaoanqi.top");
                });
            },
            
            /** Redirect to creditcardonepage */
            continueToCreditCardOnePage: function () {
                //update payment method information if additional data was changed
                this.selectPaymentMethod();
                setPaymentMethodAction(this.messageContainer); 
                return false;
            }
        });
    }
);
