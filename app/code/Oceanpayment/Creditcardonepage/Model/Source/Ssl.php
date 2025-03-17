<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
 
namespace Oceanpayment\Creditcardonepage\Model\Source;

use Magento\Framework\Option\ArrayInterface;

class Ssl implements ArrayInterface {
	
    /**
     * @return array
     */
	public function toOptionArray() {
        return [
            ['value' => 'https://', 'label' => __('https')],
            ['value' => 'http://', 'label' =>__('http')]
        ];
    }
}

