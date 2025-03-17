<?php 

namespace Oceanpayment\Creditcardonepage\Controller\Payment; 


use Magento\Framework\Controller\ResultFactory;
use Magento\Customer\Api\Data\GroupInterface;
use Magento\Sales\Api\OrderRepositoryInterface;
class Redirect extends \Magento\Framework\App\Action\Action
{
    /**
     * Customer session model
     *
     * @var \Magento\Customer\Model\Session
     */
    protected $_customerSession;
    protected $resultPageFactory;
    protected $_paymentMethod;
    protected $_checkoutSession;
    protected $checkout;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Customer\Model\Session $customerSession
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Oceanpayment\Creditcardonepage\Model\PaymentMethod $paymentMethod,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->_customerSession = $customerSession;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
        $this->_paymentMethod = $paymentMethod;
        $this->_checkoutSession = $checkoutSession;
    }

    public function execute()
    {
        
        $result_data = $this->_paymentMethod->getCheckoutParameter();
        try {
            // 将 JSON 字符串解析为 PHP 数组
            $data_arr = json_decode($result_data);
            
            if($data_arr->result == 'redirect'){
                $this->_redirect($data_arr->url);
            }

            if($data_arr->result == 'success'){
                $this->messageManager->addSuccessMessage(__($data_arr->msg));
            }elseif($data_arr->result == 'fail'){
                $this->messageManager->addErrorMessage(__($data_arr->msg));
            }elseif($data_arr->result == 'auth'){
                $this->messageManager->addErrorMessage(__($data_arr->msg));
            }
            
            $this->_redirect($data_arr->url);
        } catch (\InvalidArgumentException $e) {
            // 处理 JSON 解析错误
            echo 'Invalid JSON: ' . $e->getMessage();
            return [];
        }
        
    }

}


