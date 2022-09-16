<?php
 
namespace Ortodev\RestrictAccess\Observer;
 
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Customer\Model\Session;

class RestrictAccess implements ObserverInterface
{
 
    /**
     * RestrictAccess constructor.
     */
    public function __construct(
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Framework\App\Response\Http $response,
        \Magento\Framework\UrlFactory $urlFactory,
        \Magento\Framework\App\ActionFlag $actionFlag,
        \Magento\Customer\Model\Session $customerSession,
        \Ortodev\RestrictAccess\Helper\Data $helperData
    )
    {
        $this->_response = $response;
        $this->_urlFactory = $urlFactory;
        $this->_actionFlag = $actionFlag;
        $this->_customerSession = $customerSession;
        $this->_helperData = $helperData;
    }
 
    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        if (!$this->_helperData->getGeneralConfig('enable')) {
            return;
        }

        $allowedRoutes = [
            'customer_account_login',
            'customer_account_loginpost',
            // 'customer_account_create',
            // 'customer_account_createpost',
            'customer_account_logoutsuccess',
            'customer_account_confirm',
            'customer_account_confirmation',
            'customer_account_forgotpassword',
            'customer_account_forgotpasswordpost',
            'customer_account_createpassword',
            'customer_account_resetpasswordpost',
            'customer_section_load'
        ];
 
        $request = $observer->getEvent()->getRequest();
        $actionFullName = strtolower($request->getFullActionName());
 
        if (!$this->_customerSession->isLoggedIn() && !in_array($actionFullName, $allowedRoutes)) {
            $this->_response->setRedirect($this->_urlFactory->create()->getUrl('customer/account/login'));
        }
 
    }
}