/**
 * Copyright © 2016 Oceanpayment Design. All rights reserved.
 * See COPYING.txt for license details.
 */
define(
    [
        'jquery',
        'Magento_Checkout/js/model/quote',
        'Magento_Checkout/js/model/url-builder',
        'mage/storage',
        'Magento_Checkout/js/model/error-processor',
        'Magento_Customer/js/model/customer',
        'Magento_Checkout/js/model/full-screen-loader',
        'https://secure.oceanpayment.com/pages/js/onepage-carddata.js',
        'https://secure.oceanpayment.com/pub/js/op.js',
        'Oceanpayment_Creditcardonepage/js/view/payment/method-renderer/opjquery'
    ],
    function ($, quote, urlBuilder, storage, errorProcessor, customer, fullScreenLoader) {
        'use strict';

        return function (messageContainer) {
			
            var serviceUrl,
                payload,
                paymentData = quote.paymentMethod();

			if (Object.prototype.hasOwnProperty.call(paymentData, '__disableTmpl')) { delete paymentData.__disableTmpl; }
            /**
             * Checkout for guest and registered customer.
             */
            if (!customer.isLoggedIn()) {
                serviceUrl = urlBuilder.createUrl('/guest-carts/:cartId/payment-information', {
                    cartId: quote.getQuoteId()
                });
                payload = {
                    cartId: quote.getQuoteId(),
                    email: quote.guestEmail,
                    paymentMethod: paymentData,
                    billingAddress: quote.billingAddress()
                };
            } else {
                serviceUrl = urlBuilder.createUrl('/carts/mine/payment-information', {});
                payload = {
                    cartId: quote.getQuoteId(),
                    paymentMethod: paymentData,
                    billingAddress: quote.billingAddress()
                };
            }
			
			
		
		    if($("#card_data").val() == '' || $("#errorMsg").val() != ''){
		      //  this.errorMessage($("#errorMsg").val()); // 设置错误消息
                errorProcessor.process($("#errorMsg").val(), messageContainer);
                fullScreenLoader.stopLoader();
            }else{
                // console.log(payload);debugger
                fullScreenLoader.startLoader();
                return storage.post(
                    serviceUrl, JSON.stringify(payload)
                ).done(
                    function () {
                        //$.mage.redirect(window.checkoutConfig.payment.paypalExpress.redirectUrl[quote.paymentMethod().method]);
                        $.mage.redirect(window.checkoutConfig.payment.creditcardonepage.redirectUrl[quote.paymentMethod().method]);
                    }
                ).fail(
                    function (response) {
                        errorProcessor.process(response, messageContainer);
                        fullScreenLoader.stopLoader();
                    }
                );
            }
		
		
            // fullScreenLoader.startLoader();

            // return storage.post(
            //     serviceUrl, JSON.stringify(payload)
            // ).done(
            //     function () {
            //         //$.mage.redirect(window.checkoutConfig.payment.paypalExpress.redirectUrl[quote.paymentMethod().method]);
            //         $.mage.redirect(window.checkoutConfig.payment.creditcardonepage.redirectUrl[quote.paymentMethod().method]);
            //     }
            // ).fail(
            //     function (response) {
            //         errorProcessor.process(response, messageContainer);
            //         fullScreenLoader.stopLoader();
            //     }
            // );
        };
    }
);
