<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
 
namespace Oceanpayment\Creditcardonepage\Model\Source;

use Magento\Framework\Option\ArrayInterface;

class PaymentLanguage implements ArrayInterface {
	
    /**
     * @return array
     */
	public function toOptionArray() {
        return [
            ['value' => 'en', 'label' => __('English')],
            ['value' => 'fr', 'label' => __('French')],
            ['value' => 'de', 'label' =>__('German')],
            ['value' => 'it', 'label' => __('Italian')],
            ['value' => 'es', 'label' => __('Spanish')],
            ['value' => 'pt', 'label' =>__('Portuguese')],
            ['value' => 'ru', 'label' => __('Russian')],
            ['value' => 'ja', 'label' => __('Japanese')],
            ['value' => 'ko', 'label' =>__('Korean')],
            ['value' => 'ar', 'label' => __('Arabic')],
            ['value' => 'tr', 'label' => __('Turkish')],
            ['value' => 'zh_CN', 'label' =>__('Simplified Chinese')],
            ['value' => 'zh_HK', 'label' => __('Traditional Chinese')],
            ['value' => 'nb', 'label' => __('Norway')],
            ['value' => 'sv', 'label' =>__('Sweden')],
            ['value' => 'nl', 'label' => __('Netherlands')],
            ['value' => 'da', 'label' => __('Danish')],
            ['value' => 'fi', 'label' =>__('Finnish')],
            ['value' => 'pl', 'label' => __('Polish')],
            ['value' => 'ms', 'label' => __('Malay')],
            ['value' => 'th', 'label' =>__('Thai')],
            ['value' => 'fil', 'label' => __('Filipino')],
            ['value' => 'id', 'label' => __('Indonesian')],
            ['value' => 'vi', 'label' =>__('Vietnamesee')]
        ];
    }
}

