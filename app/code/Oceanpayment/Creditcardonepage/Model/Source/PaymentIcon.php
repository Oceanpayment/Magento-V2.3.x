<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
 
namespace Oceanpayment\Creditcardonepage\Model\Source;

use Magento\Framework\Option\ArrayInterface;

class PaymentIcon implements ArrayInterface {
	
    /**
     * @return array
     */
	public function toOptionArray() {
        return [
            ['value' => 'VISA', 'label' => __('VISA')],
            ['value' => 'Mastercard', 'label' => __('Mastercard')],
            ['value' => 'Maestro', 'label' =>__('Maestro')],
            ['value' => 'American', 'label' => __('American Express')],
            ['value' => 'Electron', 'label' => __('Electron')],
            ['value' => 'JCB', 'label' =>__('JCB')],
            ['value' => 'Diners', 'label' => __('Diners')],
            ['value' => 'Discover', 'label' => __('Discover')],
            ['value' => 'UnionPay', 'label' =>__('UnionPay')],
        ];
    }
}

