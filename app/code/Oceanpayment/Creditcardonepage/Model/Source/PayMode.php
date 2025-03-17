<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
 
namespace Oceanpayment\Creditcardonepage\Model\Source;

use Magento\Framework\Option\ArrayInterface;

class PayMode implements ArrayInterface {
	
    /**
     * @return array
     */
	public function toOptionArray() {
        return [
            ['value' => 'https://secure.oceanpayment.com/gateway/direct/pay', 'label' => __('Production')],
            ['value' => 'https://test-secure.oceanpayment.com/gateway/direct/pay', 'label' =>__('Sandbox')]
        ];
    }
}

