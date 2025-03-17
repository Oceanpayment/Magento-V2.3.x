<?php
/**
 *
 * Adyen Payment module (https://www.adyen.com/)
 *
 * Copyright (c) 2020 Adyen BV (https://www.adyen.com/)
 * See LICENSE.txt for license details.
 *
 * Author: Adyen <magento@adyen.com>
 */

namespace Oceanpayment\Creditcardonepage\Observer;

use Magento\Framework\Event\Observer;
use Magento\Payment\Observer\AbstractDataAssignObserver;
use Magento\Framework\Event\ObserverInterface;
use Magento\Sales\Model\Order;

class CheckPostDataObserver extends AbstractDataAssignObserver
{

    const PAYMENT_METHOD_NONCE = 'payment_method_nonce';
 
    /**
     * @var array
     */
    protected $additionalInformationList = [
        self::PAYMENT_METHOD_NONCE,
    ];

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {

          // Get request fields
        //   $data = $this->readDataArgument($observer);
        //   $paymentInfo = $this->readPaymentModelArgument($observer);
  
        //   // Get additional data array
        //   $additionalData = $data->getData(PaymentInterface::KEY_ADDITIONAL_DATA);
        //   echo "<pre>";
        // print_r($additionalData);exit;
        //   if (!is_array($additionalData)) {
        //       return;
        //   }

        // Get request fields
        // $action = $observer->getEvent()->getAction();
        // $request = $action->getRequest();
        // $params = $request->getParams(); // 获取所有请求参数
        $order = $observer->getEvent()->getOrder();
        $quote = $observer->getEvent()->getQuote();

        // 获取前端传递的值
        $customField = $quote->getData('card_data');

        // 保存到订单
        $order->setData('custom_field', $customField);
        $order->save();

        // $data = $this->readDataArgument($observer);
        // echo "<pre>";
        // print_r($customField);exit;

        
    }
}
