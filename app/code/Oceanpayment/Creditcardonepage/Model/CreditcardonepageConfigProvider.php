<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Oceanpayment\Creditcardonepage\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Locale\ResolverInterface;
use Magento\Customer\Helper\Session\CurrentCustomer;
use Magento\Payment\Helper\Data as PaymentHelper;

class CreditcardonepageConfigProvider implements ConfigProviderInterface
{
    /**
     * @var ResolverInterface
     */
    protected $localeResolver;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var \Magento\Customer\Helper\Session\CurrentCustomer
     */
    protected $currentCustomer;

    /**
     * @var string[]
     */
    /*protected $methodCodes = [
        Config::METHOD_WPP_BML,
        Config::METHOD_WPP_PE_EXPRESS,
        Config::METHOD_WPP_EXPRESS,
        Config::METHOD_WPP_PE_BML
    ];*/

    /**
     * @var \Magento\Payment\Model\Method\AbstractMethod[]
     */
    protected $methods = [];

    /**
     * @var PaymentHelper
     */
    protected $paymentHelper;
    
    protected $checkoutSession;
    
    protected $scopeConfig;

    /**
     * @param ConfigFactory $configFactory
     * @param ResolverInterface $localeResolver
     * @param CurrentCustomer $currentCustomer
     * @param PaymentHelper $paymentHelper
     */
    public function __construct(
        //ConfigFactory $configFactory,
        ResolverInterface $localeResolver,
        CurrentCustomer $currentCustomer,
        \Magento\Checkout\Model\Session $checkoutSession,
        ScopeConfigInterface $scopeConfig,
        PaymentHelper $paymentHelper
    ) {
        $this->localeResolver = $localeResolver;
        //$this->config = $configFactory->create();
        $this->currentCustomer = $currentCustomer;
        $this->paymentHelper = $paymentHelper;
        $this->checkoutSession = $checkoutSession;
        $this->scopeConfig = $scopeConfig;
        $code = 'oceanpaymentcreditcardonepage';
        $this->methods[$code] = $this->paymentHelper->getMethodInstance($code);
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig()
    {
        $code = 'oceanpaymentcreditcardonepage';
        $config = [];
        
        if ($this->methods[$code]->isAvailable($this->checkoutSession->getQuote())) {
            $config = [];
            $config['payment'] = [];
            $config['payment']['creditcardonepage']['redirectUrl'] = [];
            $config['payment']['creditcardonepage']['redirectUrl'][$code] = $this->getMethodRedirectUrl($code);
            $config['payment']['creditcardonepage']['pay_mode'] = $this->scopeConfig->getValue('payment/oceanpaymentcreditcardonepage/pay_mode');
            $config['payment']['creditcardonepage']['public_key'] = $this->scopeConfig->getValue('payment/oceanpaymentcreditcardonepage/public_key');
            $config['payment']['creditcardonepage']['ssl'] = $this->scopeConfig->getValue('payment/oceanpaymentcreditcardonepage/ssl');
            $config['payment']['creditcardonepage']['css_url'] = $this->scopeConfig->getValue('payment/oceanpaymentcreditcardonepage/css_url');
            $config['payment']['creditcardonepage']['payment_language'] = $this->scopeConfig->getValue('payment/oceanpaymentcreditcardonepage/payment_language');
            $config['payment']['creditcardonepage']['payment_icon'] = $this->scopeConfig->getValue('payment/oceanpaymentcreditcardonepage/payment_icon');
        }
        
        return $config;
    }

    /**
     * Return redirect URL for method
     *
     * @param string $code
     * @return mixed
     */
    protected function getMethodRedirectUrl($code)
    {
        return $this->methods[$code]->getOrderPlaceRedirectUrl();
    }


}
